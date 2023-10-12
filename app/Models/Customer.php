<?php

namespace App\Models;

use App\Observers\UuidObserver;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::observe(UuidObserver::class);
    }

    protected $fillable = [
        // foreign
        'organization_id',
        'location_id',
        // column
        'type', // origin, destination
        'name',
        'address',
        'email',
        'phone',
        'address_detail',
        'zip_code',
    ];
}
