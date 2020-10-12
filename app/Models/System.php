<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

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
