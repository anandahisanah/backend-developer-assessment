<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Connote extends Model
{
    protected $fillable = [
        // foreign
        'state_id',
        'transaction_id',
        'organization_id',
        'location_id',
        // column
        'connote_number',
        'connote_service',
        'connote_service_price',
        'connote_amount',
        'connote_code',
        'connote_booking_code',
        'connote_order',
        'connote_state',
        'zone_code_from',
        'zone_code_to',
        'surcharge_amount',
        'actual_weight',
        'volume_weight',
        'chargeable_weight',
        'connote_total_package',
        'connote_surcharge_amount',
        'connote_sla_day',
        'location_name',
        'location_type',
        'source_tariff_db',
        'id_source_tariff',
        'pod',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
