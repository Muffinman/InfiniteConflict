<?php

namespace App\Models\Pivots;

use App\Models\Building;
use App\Models\Planet;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\Pivots\PlanetBuilding
 *
 * @property int $planet_id
 * @property int $building_id
 * @property int $qty
 * @property-read Building $building
 * @property-read Planet $planet
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetBuilding newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetBuilding newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetBuilding query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetBuilding whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetBuilding wherePlanetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanetBuilding whereQty($value)
 * @mixin \Eloquent
 */
class PlanetBuilding extends Pivot
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }
}
