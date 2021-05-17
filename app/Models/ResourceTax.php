<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ResourceTax
 *
 * @property int $resource_id
 * @property int $output_resource
 * @property float $rate
 * @property-read \App\Models\Resource $outputResource
 * @property-read \App\Models\Resource $taxedResource
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceTax query()
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceTax whereOutputResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceTax whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ResourceTax whereResourceId($value)
 * @mixin \Eloquent
 */
class ResourceTax extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $with = [
        'outputResource',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxedResource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function outputResource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'output_resource');
    }
}
