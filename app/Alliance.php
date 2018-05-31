<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Ruler;

class Alliance extends Model
{
    public function rulers()
    {
        return $this->hasMany(Ruler::class);
    }
}
