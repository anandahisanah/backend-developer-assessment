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
        'customer_name',
        'customer_address',
        'customer_email',
        'customer_phone',
        'customer_address_detail',
        'customer_zip_code',
        'zone_code',
    ];
}
