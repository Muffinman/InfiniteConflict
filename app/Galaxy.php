<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\System;
use App\Planet;

class Galaxy extends Model
{

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
