<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Pivots\PlanetResource
 *
 * @property int $planet_id
 * @property int $resource_id
 * @property int $stored
 * @property int $storage
 * @property int $busy
 * @property int $output
 * @property int $abundance
 * @property-read Planet $planet
 * @property-read Resource $resource
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereAbundance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereBusy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereOutput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource wherePlanetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereStored($value)
 * @mixin \Eloquent
 * @property int $storage_cache
 * @property int $busy_cache
 * @property int $output_cache
 * @property int $abundance_cache
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereAbundanceCache($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereBusyCache($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereOutputCache($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetResource whereStorageCache($value)
 */
class ConversionResource extends Model
{
     /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromResources(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'cost_resource');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toResource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    /**
     * Production resources
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyRefundable(Builder $query): Builder
    {
        return $query->where('refund_on_completion', '=', 1);
    }
}
