<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Galaxy
 *
 * @property int $id
 * @property int $home
 * @property int $rows
 * @property int $cols
 * @property int $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Planet[] $planets
 * @property-read int|null $planets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\System[] $systems
 * @property-read int|null $systems_count
 * @method static \Illuminate\Database\Eloquent\Builder|Galaxy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Galaxy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Galaxy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Galaxy whereCols($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galaxy whereHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galaxy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galaxy whereRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Galaxy whereType($value)
 * @mixin \Eloquent
 */
class Galaxy extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galaxies';

    public function systems()
    {
        return $this->hasMany(System::class);
    }

    public function planets()
    {
        return $this->hasMany(Planet::class);
    }
}
