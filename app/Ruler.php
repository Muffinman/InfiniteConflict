<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Alliance;
use App\Planet;
use App\Fleet;
use App\Research;
use App\Resource;
use App\Building;

class Ruler extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

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
        return $this->hasMany(Research::class);
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
