<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GalaxyStartingResource
 *
 * @property int $resource_id
 * @property int|null $home_min_stored
 * @property int|null $home_max_stored
 * @property int|null $home_min_abundance
 * @property int|null $home_max_abundance
 * @property int|null $free_min_stored
 * @property int|null $free_max_stored
 * @property int|null $free_min_abundance
 * @property int|null $free_max_abundance
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereFreeMaxAbundance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereFreeMaxStored($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereFreeMinAbundance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereFreeMinStored($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereHomeMaxAbundance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereHomeMaxStored($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereHomeMinAbundance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereHomeMinStored($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalaxyStartingResource whereResourceId($value)
 * @mixin \Eloquent
 */
class GalaxyStartingResource extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @return array
     */
    public static function allAsResourceArray(): array
    {
        $galaxy_resources = [];
        foreach (static::all() as $res) {
            $galaxy_resources[$res['resource_id']] = $res;
        }
        return $galaxy_resources;
    }
}
