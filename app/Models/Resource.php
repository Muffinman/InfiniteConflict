<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property string $name
 * @property int $hp
 * @property int $ap
 * @property int $creatable
 * @property int $transferable
 * @property int $turns
 * @property float|null $interest
 * @property int $requires_storage
 * @property int $global
 * @property int $production_resource
 * @property-read \App\Models\GalaxyStartingResource|null $galaxyStartingResources
 * @property-read \App\Models\PlanetStartingResource|null $planetStartingResources
 * @method static Builder|Resource newModelQuery()
 * @method static Builder|Resource newQuery()
 * @method static Builder|Resource onlyCreatable()
 * @method static Builder|Resource onlyGlobal()
 * @method static Builder|Resource onlyHasInterest()
 * @method static Builder|Resource onlyLocal()
 * @method static Builder|Resource onlyNotHasInterest()
 * @method static Builder|Resource onlyNotRequiringStorage()
 * @method static Builder|Resource onlyProduction()
 * @method static Builder|Resource onlyRequiringStorage()
 * @method static Builder|Resource onlyTransferable()
 * @method static Builder|Resource query()
 * @method static Builder|Resource whereAp($value)
 * @method static Builder|Resource whereCreatable($value)
 * @method static Builder|Resource whereGlobal($value)
 * @method static Builder|Resource whereHp($value)
 * @method static Builder|Resource whereId($value)
 * @method static Builder|Resource whereInterest($value)
 * @method static Builder|Resource whereName($value)
 * @method static Builder|Resource whereProductionResource($value)
 * @method static Builder|Resource whereRequiresStorage($value)
 * @method static Builder|Resource whereTransferable($value)
 * @method static Builder|Resource whereTurns($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ResourceTax[] $taxes
 * @property-read int|null $taxes_count
 * @method static Builder|Resource onlyTaxable()
 * @property-read \Illuminate\Database\Eloquent\Collection|Resource[] $conversionResources
 * @property-read int|null $conversion_resources_count
 * @property-read \App\Models\ConversionResource $conversions
 */
class Resource extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Galaxy Starting Resources.
     *
     * @return HasOne
     */
    public function galaxyStartingResources(): HasOne
    {
        return $this->hasOne(GalaxyStartingResource::class, 'resource_id');
    }

    /**
     * Planet Starting Resources.
     *
     * @return HasOne
     */
    public function planetStartingResources(): HasOne
    {
        return $this->hasOne(PlanetStartingResource::class, 'resource_id');
    }

    /**
     * Get the resource conversion options.
     */
    public function conversions(): BelongsTo
    {
        return $this->belongsTo(ConversionResource::class);
    }

    /**
     * Get the resource conversion resources
     */
    public function conversionResources(): HasManyThrough
    {
        return $this->hasManyThrough(self::class,ConversionResource::class);
    }

    /**
     * Taxes on resources
     *
     * @return HasMany
     */
    public function taxes(): HasMany
    {
        return $this->hasMany(ResourceTax::class, 'resource_id');
    }


    /**
     * Get the required research.
     */
    public function requiredResearch(): BelongsToMany
    {
        return $this->belongsToMany(Research::class, 'conversion_required_research');
    }

    /**
     * Get the required buildings.
     */
    public function requiredBuildings(): BelongsToMany
    {
        return $this->belongsToMany(Building::class, 'conversion_required_buildings', 'building_id')
            ->withPivot(['qty']);
    }

    /**
     * Taxable resources
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyTaxable(Builder $query): Builder
    {
        return $query->whereHas('taxes');
    }

    /**
     * Global resources
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyGlobal(Builder $query): Builder
    {
        return $query->where('global', '=', 1);
    }

    /**
     * Local resources
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyLocal(Builder $query): Builder
    {
        return $query->where('global', '=', 0);
    }

    /**
     * Resources with interest
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyHasInterest(Builder $query): Builder
    {
        return $query->whereNotNull('interest');
    }

    /**
     * Resources with no interest
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyNotHasInterest(Builder $query): Builder
    {
        return $query->whereNull('interest');
    }

    /**
     * Transferable resources
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyTransferable(Builder $query): Builder
    {
        return $query->where('transferable', '=', 1);
    }

    /**
     * Creatable resources
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyCreatable(Builder $query): Builder
    {
        return $query->where('creatable', '=', 1);
    }

    /**
     * Production resources
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyProduction(Builder $query): Builder
    {
        return $query->where('production_resource', '=', 1);
    }


    /**
     * Resources which require storage
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyRequiringStorage(Builder $query): Builder
    {
        return $query->where('requires_storage', '=', 1);
    }

    /**
     * Resources which do not require storage
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyNotRequiringStorage(Builder $query): Builder
    {
        return $query->where('requires_storage', '=', 0);
    }

    /**
     * Limit to researched techs.
     */
    public function scopeResearched(Builder $query, ?Ruler $ruler = null): Builder
    {
        if (!$ruler) {
            $ruler = Auth::user();
        }

        return $query->whereHas('requiredResearch', function ($query) use ($ruler) {
            $query->whereIn('id', $ruler->research->modelKeys());
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
        return $query->whereHas('planets', function ($query) use ($planet) {
            $query->where('planet_id', $planet->id);
            $query->where(function ($query) use ($planet) {
                $query->where('planet_resource.stored', '<', DB::raw('planet_resource.storage'));
                $query->orWhere('resources.requires_storage', 0);
            });
        });
    }
}
