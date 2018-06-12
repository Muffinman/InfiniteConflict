<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\System;
use App\Galaxy;
use App\Ruler;
use App\Building;
use App\Unit;
use App\Fleet;
use App\Resource;

class Planet extends Model
{
    public $timestamps = false;

    // Cache var for output
    protected $output = [];

    /**
     * Get the system for this planet.
     */
    public function system()
    {
        return $this->belongsTo(System::class);
    }

    /**
     * Get the galaxy for this planet.
     */
    public function galaxy()
    {
        return $this->belongsTo(Galaxy::class);
    }

    /**
     * Get the ruler for this planet.
     */
    public function ruler()
    {
        return $this->belongsTo(Ruler::class);
    }

    /**
     * Get the buildings on this planet.
     */
    public function buildings()
    {
        return $this->belongsToMany(Building::class, 'planet_building')->withPivot('qty');
    }

    /**
     * Get the units on this planet.
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Get the fleets orbiting this planet.
     */
    public function fleets()
    {
        return $this->hasMany(Fleet::class);
    }

    /**
     * Get the resources on this planet.
     */
    public function resources()
    {
        return $this->belongsToMany(Resource::class)->withPivot('stored', 'output', 'abundance', 'stored', 'storage', 'busy');
    }

    /**
     * Scope: Just resources which output per tick.
     */
    public function productionResources()
    {
        return $this->belongsToMany(Resource::class)->withPivot('stored', 'output', 'abundance', 'stored', 'storage', 'busy')->where('production_resource', 1);
    }

    /**
     * Scope: Just resources which are not output on turn update.
     */
    public function staticResources()
    {
        return $this->belongsToMany(Resource::class)->withPivot('stored', 'output', 'abundance', 'stored', 'storage', 'busy')->where('production_resource', 0);
    }

    /**
     * Get the building queue.
     */
    public function buildingQueue()
    {
        return $this->belongsToMany(Building::class, 'planet_building_queue')->withPivot(['turns', 'started', 'rank', 'demolish'])->orderBy('rank', 'asc');
    }

    /**
     * Get the unit queue.
     */
    public function unitQueue()
    {
        return $this->belongsToMany(Unit::class, 'planet_unit_queue')->withPivot(['qty', 'turns', 'started', 'rank']);
    }

    /**
     * Get the conversion queue.
     */
    public function conversionQueue()
    {
        return $this->belongsToMany(Resource::class, 'planet_conversion_queue')->withPivot(['qty', 'turns', 'started', 'rank']);
    }

    /**
     * Get buildings available for construction.
     */
    public function availableBuildings()
    {
        //dd(Building::query()->researched()->prerequisitesMet($this)->belowMax($this)->toSql());
        return Building::query()->researched()->prerequisitesMet($this)->belowMax($this)->get();
    }


    /**
     * Filter by only populated planets.
     */
    public function scopeUnpopulated()
    {
        return $this->whereNull('ruler_id');
    }

    /**
     * Filter by only home planets.
     */
    public function scopeHomePlanets()
    {
        return $this->where('home', 1);
    }

    /**
     * Get the coords for this planet.
     */
    public function coords()
    {
        return $this->galaxy_id.'/'.$this->system_id;
    }

    /**
     * Calculated the resource output of this planet.
     */
    public function output($resource_id, $cached = true, $rebuild = false)
    {

        // Use model cache if available and allowed
        if ($cached === true && $rebuild === false && isset($this->output[$resource_id])) {
            return $this->output[$resource_id];
        }

        // Use DB cache is allowed
        if ($cached === true && $rebuild === false) {
            return $this->resources()->wherePivot('resource_id', $resource_id)->first()->pivot->output;
        }

        // Else rebuild the cache and return
        $total = 0;
        foreach ($this->buildings as $building) {
            if (isset($building->pivot)) {
                $qty = $building->pivot->qty;
                $resources = $building->resources()->wherePivot('resource_id', $resource_id)->first();
                if ($resources) {
                    $output = $resources->pivot->output;
                    $total += $qty * $output;
                }
            }

            // Update caches
            $this->resources()->syncWithoutDetaching([$resource_id => ['output' => $total]]);
            $this->output[$resource_id] = $total;

            return $total;
        }

        return 0;
    }

    /**
     * Formatted output.
     */
    public function outputFormatted($resource, $cached = true, $rebuild = false)
    {
        $output = $this->output($resource, $cached, $rebuild);

        return ($output >= 1 ? '+' : '').number_format($output);
    }
}
