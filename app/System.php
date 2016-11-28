<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Galaxy;
use App\Planet;

class System extends Model
{
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
