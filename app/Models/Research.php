<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Research
 *
 * @property int $id
 * @property string $name
 * @property int $turns
 * @property int $given
 * @method static \Illuminate\Database\Eloquent\Builder|Research newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Research newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Research query()
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereGiven($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Research whereTurns($value)
 * @mixin \Eloquent
 */
class Research extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'research';
}
