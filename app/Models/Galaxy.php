<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galaxy extends Model
{
    use HasFactory;

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
