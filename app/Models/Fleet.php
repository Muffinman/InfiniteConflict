<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fleet extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
