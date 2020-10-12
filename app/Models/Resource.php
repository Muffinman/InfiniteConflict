<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Galaxy Starting Resources.
     */
    public function galaxyStartingResources()
    {
        return $this->hasOne(GalaxyStartingResource::class, 'resource_id');
    }

    /**
     * Planet Starting Resources.
     */
    public function planetStartingResources()
    {
        return $this->hasOne(PlanetStartingResource::class, 'resource_id');
    }
}
