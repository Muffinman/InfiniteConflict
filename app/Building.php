<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use App\Planet;
use App\Resource;
use App\Building;

use Auth;
use DB;

class Building extends Model
{
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
        return $this->belongsToMany(Resource::class)->withPivot('cost', 'output', 'single_output', 'stores', 'interest', 'abundance', 'refund_on_completion');
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
        return $this->belongsToMany(Building::class, 'building_required_buildings', 'requirement_id')->withPivot(['qty']);
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
     * Limit to researched techs
     */
    public function scopeResearched($query)
    {
        return $query->whereHas('requiredResearch', function($query) {
            $query->whereIn('id', Auth::user()->research->modelKeys());
        })
        ->doesntHave('requiredResearch', 'or');
    }


    /**
     * Limit to buildings with prerequisites met
     */
    public function scopePrerequisitesMet($query, Planet $planet)
    {
        $buildings = $planet->buildings->modelKeys();
        return $query->whereHas('planets', function($query) use ($buildings, $planet) {
            $query->whereIn('id', $buildings);
            $query->where('planet_id', $planet->id);
        })
        ->doesntHave('requiredBuildings', 'or');
    }


    /**
     * Limit to buildings below max qty
     */
    public function scopeBelowMax($query, Planet $planet)
    {
        $query->whereHas('planets', function($query) use ($planet) {
            $query->where('planet_id', $planet->id);
            $query->where(function ($query) use ($planet) {
                $query->where('buildings.max', '>=', DB::raw('planet_building.qty'));
                $query->orWhere('max', NULL);
            });
        });
    }

}
