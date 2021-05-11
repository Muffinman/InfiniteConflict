<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlanetStartingBuilding
 *
 * @property int $building_id
 * @property int $qty
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingBuilding newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingBuilding newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingBuilding query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingBuilding whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetStartingBuilding whereQty($value)
 * @mixin \Eloquent
 */
class PlanetStartingBuilding extends Model
{
    use HasFactory;

    public $timestamps = false;
}
