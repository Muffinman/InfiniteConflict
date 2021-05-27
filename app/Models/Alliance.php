<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Alliance
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $asset_score
 * @property int $combat_score
 * @property int|null $asset_rank
 * @property int|null $combat_rank
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ruler[] $rulers
 * @property-read int|null $rulers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereAssetRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereAssetScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereCombatRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereCombatScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alliance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Alliance extends Model
{
    use HasFactory;

    public function rulers()
    {
        return $this->hasMany(Ruler::class);
    }
}
