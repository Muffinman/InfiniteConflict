<?php

namespace App\Models;

use App\Models\Pivots\BuildingQueue;
use App\Models\Pivots\ConversionQueue;
use App\Models\Pivots\PlanetBuilding;
use App\Models\Pivots\PlanetResource;
use App\Models\Pivots\UnitQueue;
use App\Scopes\PlanetPopulated;
use App\Scopes\PlanetUnpopulated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Models\Planet
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $ruler_id
 * @property int $galaxy_id
 * @property int $system_id
 * @property int $col
 * @property int $row
 * @property int $home
 * @property int $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Building[] $buildingQueue
 * @property-read int|null $building_queue_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Building[] $buildings
 * @property-read int|null $buildings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $conversionQueue
 * @property-read int|null $conversion_queue_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fleet[] $fleets
 * @property-read int|null $fleets_count
 * @property-read \App\Models\Galaxy $galaxy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $productionResources
 * @property-read int|null $production_resources_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @property-read \App\Models\Ruler|null $ruler
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $staticResources
 * @property-read int|null $static_resources_count
 * @property-read \App\Models\System $system
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit[] $unitQueue
 * @property-read int|null $unit_queue_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit[] $units
 * @property-read int|null $units_count
 * @method static \Database\Factories\PlanetFactory factory(...$parameters)
 * @method static Builder|Planet homePlanets()
 * @method static Builder|Planet newModelQuery()
 * @method static Builder|Planet newQuery()
 * @method static Builder|Planet query()
 * @method static Builder|Planet unpopulated()
 * @method static Builder|Planet whereCol($value)
 * @method static Builder|Planet whereGalaxyId($value)
 * @method static Builder|Planet whereHome($value)
 * @method static Builder|Planet whereId($value)
 * @method static Builder|Planet whereName($value)
 * @method static Builder|Planet whereRow($value)
 * @method static Builder|Planet whereRulerId($value)
 * @method static Builder|Planet whereSystemId($value)
 * @method static Builder|Planet whereType($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Building[] $buildingsInQueue
 * @property-read int|null $buildings_in_queue_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $conversionsInQueue
 * @property-read int|null $conversions_in_queue_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit[] $unitsInQueue
 * @property-read int|null $units_in_queue_count
 */
class Planet extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @inheritDoc
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PlanetPopulated);
    }

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
        return $this->belongsToMany(Building::class, 'planet_building')
            ->withPivot('qty')
            ->using(PlanetBuilding::class);
    }

    /**
     * Get the units on this planet.
     */
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'planet_unit')
            ->withPivot('qty')
            ->using(PlanetBuilding::class);
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
        return $this->belongsToMany(Resource::class)
            ->withPivot(['stored', 'abundance', 'output_cache', 'storage_cache', 'busy_cache', 'abundance_cache'])
            ->using(PlanetResource::class);
    }

    /**
     * Scope: Just resources which output per tick.
     */
    public function productionResources()
    {
        return $this->belongsToMany(Resource::class)
            ->withPivot(['stored', 'abundance', 'output_cache', 'storage_cache', 'busy_cache', 'abundance_cache'])
            ->where('production_resource', '=', 1)
            ->using(PlanetResource::class);
    }

    /**
     * Scope: Just resources which are not output on turn update.
     */
    public function staticResources()
    {
        return $this->belongsToMany(Resource::class)
            ->withPivot(['stored', 'abundance', 'output_cache', 'storage_cache', 'busy_cache', 'abundance_cache'])
            ->where('production_resource', '=', 0)
            ->using(PlanetResource::class);
    }

    /**
     * Get the building queue.
     */
    public function buildingQueue()
    {
        return $this->hasMany(BuildingQueue::class)
            ->orderBy('rank', 'asc');
    }

    /**
     * Get the building queue.
     */
    public function buildingsInQueue()
    {
        return $this->belongsToMany(Building::class, 'planet_building_queue')
            ->using(BuildingQueue::class)
            ->withPivot(['turns', 'started', 'rank', 'demolish'])
            ->orderByPivot('rank', 'asc');
    }

    /**
     * Get the unit queue.
     */
    public function unitQueue()
    {
        return $this->hasMany(UnitQueue::class)
            ->orderBy('rank', 'asc');
    }

    /**
     * Get the unit queue.
     */
    public function unitsInQueue()
    {
        return $this->belongsToMany(Unit::class, 'planet_unit_queue')
            ->using(UnitQueue::class)
            ->withPivot(['qty', 'turns', 'started', 'rank'])
            ->orderByPivot('rank', 'asc');
    }

    /**
     * Get the unit queue.
     */
    public function conversionQueue()
    {
        return $this->hasMany(ConversionQueue::class)
            ->orderBy('rank', 'asc');
    }

    /**
     * Get the conversion queue.
     */
    public function conversionsInQueue()
    {
        return $this->belongsToMany(Resource::class, 'planet_conversion_queue')
            ->using(ConversionQueue::class)
            ->withPivot(['qty', 'turns', 'started', 'rank'])
            ->orderByPivot('rank', 'asc');
    }

    /**
     * Get buildings available for construction.
     */
    public function availableBuildings()
    {
        $test = Building::query()
            ->researched($this->ruler)
            ->prerequisitesMet($this)
            ->belowMax($this)
            ->get();
        return $test;
    }

    /**
     * Get buildings available for construction.
     */
    public function availableUnits()
    {
        return Unit::query()
            ->researched($this->ruler)
            ->prerequisitesMet($this)
            ->belowMax($this)
            ->get();
    }

    /**
     * Get buildings available for construction.
     */
    public function availableConversions()
    {
        return Resource::query()
            ->researched($this->ruler)
            ->prerequisitesMet($this)
            ->belowMax($this)
            ->get();
    }

    /**
     * Filter by only populated planets.
     *
     * @param Builder
     * @return Builder
     */
    public function scopeUnpopulated(Builder $query)
    {
        return $query->withoutGlobalScope(PlanetPopulated::class)
            ->withGlobalScope(PlanetUnpopulated::class, new PlanetUnpopulated);
    }

    /**
     * Filter by only home planets.
     */
    public function scopeHomePlanets(Builder $query)
    {
        return $query->where('home', '=', 1);
    }

    /**
     * Get the coords for this planet.
     */
    public function coords()
    {
        return $this->galaxy_id.'/'.$this->system_id;
    }

    /**
     * Populate current planet with starting buildings.
     *
     * @return array
     */
    public function populateStartingBuildings()
    {
        $starting_buildings = PlanetStartingBuilding::all()->toArray();
        $rekey = [];
        foreach ($starting_buildings as $b) {
            $rekey[$b['building_id']] = ['qty' => $b['qty']];
        }
        $starting_buildings = $rekey;

        return $this->buildings()->sync($starting_buildings);
    }


    /**
     * Calculated the resource output of this planet.
     *
     * @param Resource $resource
     * @param bool $useCache
     * @return int
     */
    public function calcResourceOutput(\App\Models\Resource $resource, bool $useCache = true): int
    {
        // Use DB cache is allowed
        if ($useCache === true) {
            return $this->resources()->wherePivot('resource_id', $resource->id)->first()->pivot->output_cache;
        }

        // Else rebuild the cache and return
        $total = 0;
        foreach ($this->buildings as $building) {
            if (isset($building->pivot)) {
                $qty = $building->pivot->qty;
                $buildingResource = $building->resources()->wherePivot('resource_id', $resource->id)->first();
                if ($buildingResource) {
                    $output = $buildingResource->pivot->output;
                    $total += $qty * $output;
                }
            }

            // Update caches
            $this->resources()->syncWithoutDetaching([$resource->id => ['output_cache' => $total]]);
        }

        return $total;
    }


    /**
     * @param \App\Models\Resource $resource
     * @param bool $useCache
     * @return int|mixed
     */
    public function calcResourceStorage(\App\Models\Resource $resource, bool $useCache = true): int
    {
        if ($useCache === true) {
            return $this->resources()->wherePivot('resource_id', $resource->id)->first()->pivot->storage_cache;
        }

        $storage = $this->buildings()->with([
            'resources' => function ($q) use ($resource) {
                $q->where('id', $resource->id);
            }
        ])
        ->get()
        ->sum(function ($item) use ($resource) {
            $buildingResource = $item->resources->where('id', $resource->id)->first();
            return $item->pivot->qty * ($buildingResource ? $buildingResource->pivot->stores : 0);
        });

        $this->resources()->syncWithoutDetaching([$resource->id => ['storage_cache' => $storage]]);

        return $storage;
    }

    /**
     * @param \App\Models\Resource $resource
     * @param bool $useCache
     * @return int|mixed
     */
    public function calcResourceAbundance(\App\Models\Resource $resource, bool $useCache = true): int
    {
        if ($useCache === true) {
            return $this->resources()->wherePivot('resource_id', $resource->id)->first()->pivot->abundance_cache;
        }

        $baseAbundance = $this->resources()
            ->where('id', $resource->id)
            ->first()
            ->pivot
            ->abundance;

        $buildingAbundance = $this->buildings()->with([
            'resources' => function ($q) use ($resource) {
                $q->where('id', $resource->id);
            }
        ])
        ->get()
        ->sum(function ($item) use ($resource) {
            $buildingResource = $item->resources->where('id', $resource->id)->first();
            return $item->pivot->qty * ($buildingResource ? $buildingResource->pivot->abundance : 0);
        });

        $abundance = $baseAbundance + $buildingAbundance;

        $this->resources()->syncWithoutDetaching([$resource->id => ['abundance_cache' => $abundance]]);

        return $abundance;
    }

    /**
     * Formatted output.
     */
    public function outputFormatted(\App\Models\Resource $resource, bool $useCache = true)
    {
        $output = $this->calcResourceOutput($resource, $useCache);

        return ($output >= 1 ? '+' : '-') . number_format($output);
    }

    /**
     * @param Collection $resources
     * @param array $galaxy_resources
     * @param array $planet_resources
     */
    public function attachStartingResources(Collection $resources, array $galaxy_resources, array $planet_resources)
    {
        $attached_resources = [];
        foreach ($resources as $resource) {
            $storage = $stored = $abundance = 0;

            // Home planet in home gal
            if ($this->home && isset($planet_resources[$resource->id])) {
                $stored = $planet_resources[$resource->id]['stored'];
                $abundance = $planet_resources[$resource->id]['abundance'];
            }

            // Normal planet in home gal
            elseif ($this->galaxy->home && isset($galaxy_resources[$resource->id])) {
                $stored = rand($galaxy_resources[$resource->id]['home_min_stored'], $galaxy_resources[$resource->id]['home_max_stored']);
                $abundance = rand($galaxy_resources[$resource->id]['home_min_abundance'], $galaxy_resources[$resource->id]['home_max_abundance']);
            }

            // Normal planet in free gal
            elseif (isset($galaxy_resources[$resource->id])) {
                $stored = 0;
                $abundance = rand($galaxy_resources[$resource->id]['free_min_abundance'], $galaxy_resources[$resource->id]['free_max_abundance']);
            }

            //if ($resource->requires_storage) {
            //    $storage = $this->calcResourceStorage($resource, false);
            //}

            if ($storage !== 0 || $stored !== 0 || $abundance !== 0) {
                $attached_resources[$resource->id] = [
                    'stored' => $stored,
                    'abundance' => $abundance,
                    //'storage_cache' => $storage,
                ];
            }
        }

        $this->resources()->syncWithoutDetaching($attached_resources);
    }
}
