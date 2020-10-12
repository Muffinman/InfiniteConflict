<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

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
