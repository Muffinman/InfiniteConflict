<?php

namespace App;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Ruler extends Authenticatable implements AuthenticatableContract, CanResetPasswordContract, MustVerifyEmailContract, JWTSubject
{
    use CanResetPassword, Notifiable, MustVerifyEmail;

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

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function homePlanet()
    {
        return $this->hasMany(Planet::class)->where('home', 1)->first();
    }

    public function planets()
    {
        return $this->hasMany(Planet::class);
    }

    public function fleets()
    {
        return $this->hasMany(Fleet::class);
    }

    public function research()
    {
        return $this->belongsToMany(Research::class, 'ruler_research');
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function alliance()
    {
        return $this->belongsTo(Alliance::class);
    }

    public function researchedBuildings()
    {
        return $this->hasManyThrough(Building::class, Research::class);
    }
}
