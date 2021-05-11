<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit
 *
 * @property int $id
 * @property string $name
 * @property int|null $drive
 * @property int $turns
 * @property int|null $max_per_ruler
 * @property int|null $max_per_fleet
 * @property int|null $max_per_planet
 * @property int $can_invade
 * @property int $can_colonise
 * @property int $hp
 * @property int $ap
 * @property-read \App\Models\Fleet $fleet
 * @property-read \App\Models\Planet $planet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereAp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereCanColonise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereCanInvade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereDrive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereMaxPerFleet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereMaxPerPlanet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereMaxPerRuler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Unit whereTurns($value)
 * @mixin \Eloquent
 */
class Unit extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }

    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
