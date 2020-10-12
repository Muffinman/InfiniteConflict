<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alliance extends Model
{
    use HasFactory;

    public function rulers()
    {
        return $this->hasMany(Ruler::class);
    }
}
