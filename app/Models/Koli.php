<?php

namespace App\Models;

use App\Observers\UuidObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Koli extends Model
{
    protected $table = 'kolies';
    
    protected static function boot()
    {
        parent::boot();

        self::observe(UuidObserver::class);
    }

    protected $fillable = [
        // foreign
        'formula_id',
        'package_id',
        'connote_id',
        // column
        'length',
        'awb_url',
        'chargeable_weight',
        'width',
        'surcharge',
        'height',
        'description',
        'volume',
        'weight',
        'code',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function connote(): BelongsTo
    {
        return $this->belongsTo(Connote::class);
    }
}
