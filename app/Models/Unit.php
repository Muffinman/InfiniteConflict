<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Unit
 *
 * @property int $id
 * @property string $name
 * @property int|null $drive
 * @property int $turns
 * @property int|null $max_per_ruler
 * @property int|null $max_per_fleet
 * @property int|null $max_per_planet
 * @property int $can_invade
 * @property int $can_colonise
 * @property int $hp
 * @property int $ap
 * @property-read \App\Models\Fleet $fleet
 * @property-read \App\Models\Planet $planet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereAp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereCanColonise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereCanInvade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereDrive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereMaxPerFleet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereMaxPerPlanet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereMaxPerRuler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereTurns($value)
 * @mixin \Eloquent
 */
class Unit extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }

    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * Get the required research.
     */
    public function requiredResearch(): BelongsToMany
    {
        return $this->belongsToMany(Research::class, 'unit_required_research');
    }

    /**
     * Get the required buildings.
     */
    public function requiredBuildings(): BelongsToMany
    {
        return $this->belongsToMany(Building::class, 'unit_required_buildings', 'requirement_id')
            ->withPivot(['qty']);
    }

    /**
     * Limit to researched techs.
     */
    public function scopeResearched(Builder $query): Builder
    {
        return $query->whereHas('requiredResearch', function ($query) {
            $query->whereIn('id', Auth::user()->research->modelKeys());
        })
            ->doesntHave('requiredResearch', 'or');
    }

    /**
     * Limit to buildings with prerequisites met.
     */
    public function scopePrerequisitesMet(Builder $query, Planet $planet): Builder
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
    public function scopeBelowMax(Builder $query, Planet $planet): Builder
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
