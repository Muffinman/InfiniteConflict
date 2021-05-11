<?php

namespace App\Models;

use App\Models\Pivots\BuildingResource;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Building
 *
 * @property int $id
 * @property string $name
 * @property int|null $turns
 * @property int|null $max
 * @property int|null $demolish_turns
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Planet[] $planets
 * @property-read int|null $planets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Building[] $requiredBuildings
 * @property-read int|null $required_buildings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Research[] $requiredResearch
 * @property-read int|null $required_research_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @method static \Illuminate\Database\Eloquent\Builder|Building belowMax(\App\Models\Planet $planet)
 * @method static \Illuminate\Database\Eloquent\Builder|Building newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Building newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Building prerequisitesMet(\App\Models\Planet $planet)
 * @method static \Illuminate\Database\Eloquent\Builder|Building query()
 * @method static \Illuminate\Database\Eloquent\Builder|Building researched()
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereDemolishTurns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereTurns($value)
 * @mixin \Eloquent
 */
class Building extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Cache var for output
    protected $output = [];

    /**
     * Get planets this building is built on.
     */
    public function planets()
    {
        return $this->belongsToMany(Planet::class, 'planet_building')->withPivot('qty');
    }

    /**
     * Get building resources.
     */
    public function resources()
    {
        return $this->belongsToMany(Resource::class)
            ->withPivot('cost', 'output', 'single_output', 'stores', 'interest', 'abundance', 'refund_on_completion')
            ->using(BuildingResource::class);
    }

    /**
     * Get the required research.
     */
    public function requiredResearch()
    {
        return $this->belongsToMany(Research::class, 'building_required_research');
    }

    /**
     * Get the required buildings.
     */
    public function requiredBuildings()
    {
        return $this->belongsToMany(self::class, 'building_required_buildings', 'requirement_id')->withPivot(['qty']);
    }

    /**
     * Calculated the resource output of this planet.
     */
    public function output($planet_id, $resource_id, $cached = true)
    {

        // Use model cache if available and allowed
        if ($cached === true && isset($this->output[$planet_id][$resource_id])) {
            return $this->output[$planet_id][$resource_id];
        }

        // Else rebuild the cache and return
        $qty = $this->planets()->wherePivot('planet_id', $planet_id)->first()->pivot->qty;
        $resources = $this->resources()->wherePivot('resource_id', $resource_id)->first();
        $total = 0;
        if ($resources) {
            $output = $resources->pivot->output;
            $total += $qty * $output;
            // Update cache
            $this->output[$planet_id][$resource_id] = $total;

            return $total;
        }

        return 0;
    }

    /**
     * Formatted output.
     */
    public function outputFormatted($planet_id, $resource, $cached = true)
    {
        $output = $this->output($planet_id, $resource, $cached);

        return ($output >= 1 ? '+' : '').number_format($output);
    }

    /**
     * Limit to researched techs.
     */
    public function scopeResearched($query)
    {
        return $query->whereHas('requiredResearch', function ($query) {
            $query->whereIn('id', Auth::user()->research->modelKeys());
        })
        ->doesntHave('requiredResearch', 'or');
    }

    /**
     * Limit to buildings with prerequisites met.
     */
    public function scopePrerequisitesMet($query, Planet $planet)
    {
        $buildings = $planet->buildings->modelKeys();

        return $query->whereHas('planets', function ($query) use ($buildings, $planet) {
            $query->whereIn('id', $buildings);
            $query->where('planet_id', $planet->id);
        })
        ->doesntHave('requiredBuildings', 'or');
    }

    /**
     * Limit to buildings below max qty.
     */
    public function scopeBelowMax($query, Planet $planet)
    {
        $query->whereHas('planets', function ($query) use ($planet) {
            $query->where('planet_id', $planet->id);
            $query->where(function ($query) use ($planet) {
                $query->where('buildings.max', '>=', DB::raw('planet_building.qty'));
                $query->orWhere('max', null);
            });
        });
    }
}
