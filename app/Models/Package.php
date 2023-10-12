<?php

namespace App\Models;

use App\Observers\UuidObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected static function boot()
    {
        parent::boot();

        self::observe(UuidObserver::class);
    }

    protected $fillable = [
        // foreign
        'transaction_id',
        'location_id',
        'organization_id',
        'customer_attribute_id',
        'connote_id',
        'customer_origin_id',
        'customer_destination_id',
        'custom_field_id',
        'current_location_id',
        // column
        'customer_name',
        'customer_code',
        'transaction_amount',
        'transaction_discount',
        'transaction_additional_field',
        'transaction_payment_type',
        'transaction_state',
        'transaction_code',
        'transaction_order',
        'transaction_payment_type_name',
        'transaction_cash_amount',
        'transaction_cash_change',
    ];

    public function customer_attribute(): BelongsTo
    {
        return $this->belongsTo(CustomerAttribute::class);
    }

    public function connote(): BelongsTo
    {
        return $this->belongsTo(Connote::class);
    }

    public function customer_origin(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->where('type', 'origin');
    }

    public function customer_destination(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->where('type', 'destination');
    }

    public function kolies(): HasMany
    {
        return $this->hasMany(Koli::class);
    }

    public function custom_field(): BelongsTo
    {
        return $this->belongsTo(CustomField::class);
    }

    public function current_location(): BelongsTo
    {
        return $this->belongsTo(CurrentLocation::class);
    }
}
