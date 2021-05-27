<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System
 *
 * @property int $id
 * @property int $galaxy_id
 * @property int $rows
 * @property int $cols
 * @property int $type
 * @property int $home
 * @property int $col
 * @property int $row
 * @property-read \App\Models\Galaxy $galaxy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Planet[] $planets
 * @property-read int|null $planets_count
 * @method static \Illuminate\Database\Eloquent\Builder|System newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|System newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|System query()
 * @method static \Illuminate\Database\Eloquent\Builder|System whereCol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereCols($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereGalaxyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereType($value)
 * @mixin \Eloquent
 */
class System extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function galaxy()
    {
        return $this->belongsTo(Galaxy::class);
    }

    public function planets()
    {
        return $this->hasMany(Planet::class);
    }
}
