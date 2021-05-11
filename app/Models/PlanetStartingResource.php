<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlanetStartingResource
 *
 * @property int $resource_id
 * @property int $stored
 * @property int $abundance
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingResource whereAbundance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingResource whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingResource whereStored($value)
 * @mixin \Eloquent
 */
class PlanetStartingResource extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @return array
     */
    public static function allAsResourceArray(): array
    {
        $planet_resources = [];
        foreach (static::all() as $res) {
            $planet_resources[$res['resource_id']] = $res;
        }
        return $planet_resources;
    }
}
