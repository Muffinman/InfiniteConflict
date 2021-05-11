<?php

namespace App\Models\Pivots;

use App\Models\Planet;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
 */
class PlanetResource extends Pivot
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
