<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property string $name
 * @property int $hp
 * @property int $ap
 * @property int $creatable
 * @property int $transferable
 * @property int $turns
 * @property float|null $interest
 * @property int $requires_storage
 * @property int $global
 * @property int $production_resource
 * @property-read \App\Models\GalaxyStartingResource|null $galaxyStartingResources
 * @property-read \App\Models\PlanetStartingResource|null $planetStartingResources
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyCreatable()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyGlobal()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyHasInterest()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyLocal()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyNotHasInterest()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyNotRequiringStorage()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyProduction()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyRequiringStorage()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyTransferable()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereAp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereCreatable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereGlobal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereProductionResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereRequiresStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereTransferable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereTurns($value)
 * @mixin \Eloquent
 */
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

    /**
     * Global resources
     *
     * @return mixed
     */
    public function scopeOnlyGlobal()
    {
        return $this->where('global', 1);
    }

    /**
     * Local resources
     *
     * @return mixed
     */
    public function scopeOnlyLocal()
    {
        return $this->where('global', 0);
    }

    /**
     * Resources with interest
     *
     * @return mixed
     */
    public function scopeOnlyHasInterest()
    {
        return $this->whereNotNull('interest');
    }

    /**
     * Resources with no interest
     *
     * @return mixed
     */
    public function scopeOnlyNotHasInterest()
    {
        return $this->whereNull('interest');
    }

    /**
     * Transferable resources
     *
     * @return mixed
     */
    public function scopeOnlyTransferable()
    {
        return $this->where('transferable', 1);
    }

    /**
     * Creatable resources
     *
     * @return mixed
     */
    public function scopeOnlyCreatable()
    {
        return $this->where('creatable', 1);
    }

    /**
     * Production resources
     *
     * @return mixed
     */
    public function scopeOnlyProduction()
    {
        return $this->where('production', 1);
    }


    /**
     * Resources which require storage
     *
     * @return mixed
     */
    public function scopeOnlyRequiringStorage()
    {
        return $this->where('requires_storage', 1);
    }

    /**
     * Resources which do not require storage
     *
     * @return mixed
     */
    public function scopeOnlyNotRequiringStorage()
    {
        return $this->where('requires_storage', 0);
    }
}
