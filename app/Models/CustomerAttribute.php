<?php

namespace App\Models;

use App\Observers\UuidObserver;
use Illuminate\Database\Eloquent\Model;

class CustomerAttribute extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::observe(UuidObserver::class);
    }

    protected $fillable = [
        // column
        'sales_name',
        'top',
        'type',
    ];
}
