<?php

namespace App\Models;

use App\Observers\UuidObserver;
use Illuminate\Database\Eloquent\Model;

class KoliCustomField extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::observe(UuidObserver::class);
    }

    protected $fillable = [
        // column
        'awb_sicepat',
        'price',
    ];
}
