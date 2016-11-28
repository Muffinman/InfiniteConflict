<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Fleet;
use App\Planet;
use App\Resource;

class Unit extends Model
{
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
