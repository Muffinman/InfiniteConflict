<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResourceTax extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $with = [
        'outputResource',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxedResource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function outputResource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'output_resource');
    }
}
