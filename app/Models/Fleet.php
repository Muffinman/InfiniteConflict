<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Fleet
 *
 * @property int $id
 * @property string $name
 * @property int|null $ruler_id
 * @property int|null $planet_id
 * @property int|null $destination_id
 * @property int $moving
 * @property int|null $turns
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereDestinationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereMoving($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet wherePlanetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereRulerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fleet whereTurns($value)
 * @mixin \Eloquent
 */
class Fleet extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
