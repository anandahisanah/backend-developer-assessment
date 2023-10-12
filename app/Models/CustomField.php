<?php

namespace App\Models;

use App\Observers\UuidObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomField extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::observe(UuidObserver::class);
    }

    protected $fillable = [
        // foreign
        'pacakage_id',
        // column
        'note',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
