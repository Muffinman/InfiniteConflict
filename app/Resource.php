<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
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
