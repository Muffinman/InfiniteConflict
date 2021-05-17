<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\Ruler
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property int $planet_limit
 * @property int $queue_limit
 * @property int $asset_score
 * @property int $combat_score
 * @property int|null $asset_rank
 * @property int|null $combat_rank
 * @property int|null $alliance_leaving
 * @property int|null $alliance_cooldown
 * @property int|null $alliance_id
 * @property int|null $alliance_level
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $social_provider
 * @property string|null $social_token
 * @property string|null $social_refresh_token
 * @property string|null $social_avatar
 * @property string|null $social_expires_at
 * @property-read \App\Models\Alliance|null $alliance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fleet[] $fleets
 * @property-read int|null $fleets_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Planet[] $planets
 * @property-read int|null $planets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Research[] $research
 * @property-read int|null $research_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Building[] $researchedBuildings
 * @property-read int|null $researched_buildings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\RulerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereAllianceCooldown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereAllianceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereAllianceLeaving($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereAllianceLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereAssetRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereAssetScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereCombatRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereCombatScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler wherePlanetLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereQueueLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereSocialAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereSocialExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereSocialProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereSocialRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereSocialToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruler whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ruler extends Authenticatable implements AuthenticatableContract, CanResetPasswordContract, MustVerifyEmailContract
{
    use CanResetPassword, Notifiable, MustVerifyEmail, HasFactory, HasApiTokens;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rulers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'social_provider', 'social_token', 'social_refresh_token', 'social_avatar', 'social_expires_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function homePlanet()
    {
        return $this->hasMany(Planet::class)->where('home', '=', 1)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planets()
    {
        return $this->hasMany(Planet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fleets()
    {
        return $this->hasMany(Fleet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function research()
    {
        return $this->belongsToMany(Research::class, 'ruler_research');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'ruler_resource');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alliance()
    {
        return $this->belongsTo(Alliance::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function researchedBuildings()
    {
        return $this->hasManyThrough(Building::class, Research::class);
    }
}
