<?php

namespace App\Models\Pivots;

use App\Models\Planet;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\Pivots\BuildingQueue
 *
 * @property int $building_id
 * @property int $resource_id
 * @property int $cost
 * @property int $output
 * @property int|null $single_output
 * @property int $stores
 * @property float $interest
 * @property int $abundance
 * @property int $refund_on_completion
 * @property-read Building $building
 * @property-read Resource $resource
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereAbundance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereOutput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereRefundOnCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereSingleOutput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingResource whereStores($value)
 * @mixin \Eloquent
 * @property int $id
 * @property int $planet_id
 * @property int $qty
 * @property int $turns
 * @property int $started
 * @property int $rank
 * @property-read Resource $convertingFromResource
 * @property-read Resource $convertingToResource
 * @method static \Illuminate\Database\Eloquent\Builder|ConversionQueue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversionQueue wherePlanetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversionQueue whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversionQueue whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversionQueue whereStarted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConversionQueue whereTurns($value)
 */
class ConversionQueue extends Pivot
{
    /**
     * @var string
     */
    protected $table = 'planet_conversion_queue';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planet(): BelongsTo
    {
        return $this->belongsTo(Planet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }
}
