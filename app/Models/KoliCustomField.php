<?php

namespace App\Models;

use App\Observers\UuidObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KoliCustomField extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::observe(UuidObserver::class);
    }

    protected $fillable = [
        // foreign
        'koli_id',
        // column
        'awb_sicepat',
        'price',
    ];

    public function koli(): BelongsTo
    {
        return $this->belongsTo(Koli::class);
    }
}
