<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // foreign
            'transaction_id' => $this->transaction_id,
            'location_id' => $this->location_id,
            'organization_id' => $this->organization_id,
            // column
            'customer_name' => $this->customer_name,
            'customer_code' => $this->customer_code,
            'transaction_amount' => $this->transaction_amount,
            'transaction_discount' => $this->transaction_discount,
            'transaction_additional_field' => $this->transaction_additional_field,
            'transaction_payment_type' => $this->transaction_payment_type,
            'transaction_state' => $this->transaction_state,
            'transaction_code' => $this->transaction_code,
            'transaction_order' => $this->transaction_order,
            'transaction_payment_type_name' => $this->transaction_payment_type_name,
            'transaction_cash_amount' => $this->transaction_cash_amount,
            'transaction_cash_change' => $this->transaction_cash_change,
            // timestamp
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // relation
            'customer_attribute' => [
                'Nama_Sales' => $this->customer_attribute->sales_name,
                'TOP' => $this->customer_attribute->top,
                'Jenis_Pelanggan' => $this->customer_attribute->type,
            ],
            'connote' => [
                // primary
                'connote_id' => $this->connote->uuid,
                // foreign
                'connote_state_id' => $this->connote->connote_state_id,
                'transaction_id' => $this->connote->transaction_id,
                'organization_id' => $this->connote->organization_id,
                'location_id' => $this->connote->location_id,
                // column
                'connote_number' => $this->connote->connote_number,
                'connote_service' => $this->connote->connote_service,
                'connote_service_price' => $this->connote->connote_service_price,
                'connote_amount' => $this->connote->connote_amount,
                'connote_code' => $this->connote->connote_code,
                'connote_booking_code' => $this->connote->connote_booking_code,
                'connote_order' => $this->connote->connote_order,
                'connote_state' => $this->connote->connote_state,
                'zone_code_from' => $this->connote->zone_code_from,
                'zone_code_to' => $this->connote->zone_code_to,
                'surcharge_amount' => $this->connote->surcharge_amount,
                'actual_weight' => $this->connote->actual_weight,
                'volume_weight' => $this->connote->volume_weight,
                'chargeable_weight' => $this->connote->chargeable_weight,
                'connote_total_package' => $this->connote->connote_total_package,
                'connote_surcharge_amount' => $this->connote->connote_surcharge_amount,
                'connote_sla_day' => $this->connote->connote_sla_day,
                'location_name' => $this->connote->location_name,
                'location_type' => $this->connote->location_type,
                'source_tariff_db' => $this->connote->source_tariff_db,
                'id_source_tariff' => $this->connote->id_source_tariff,
                'pod' => $this->connote->pod,
                'history' => json_decode($this->connote->history),
            ],
            'origin_data' => [
                // foreign
                'organization_id' => $this->customer_origin->organization_id,
                'location_id' => $this->customer_origin->location_id,
                // column
                'customer_name' => $this->customer_origin->customer_name,
                'customer_address' => $this->customer_origin->customer_address,
                'customer_email' => $this->customer_origin->customer_email,
                'customer_phone' => $this->customer_origin->customer_phone,
                'customer_address_detail' => $this->customer_origin->customer_address_detail,
                'customer_zip_code' => $this->customer_origin->customer_zip_code,
                'zone_code' => $this->customer_origin->zone_code,
            ],
            'destination_data' => [
                // foreign
                'organization_id' => $this->customer_destination->organization_id,
                'location_id' => $this->customer_destination->location_id,
                // column
                'customer_name' => $this->customer_destination->customer_name,
                'customer_address' => $this->customer_destination->customer_address,
                'customer_email' => $this->customer_destination->customer_email,
                'customer_phone' => $this->customer_destination->customer_phone,
                'customer_address_detail' => $this->customer_destination->customer_address_detail,
                'customer_zip_code' => $this->customer_destination->customer_zip_code,
                'zone_code' => $this->customer_destination->zone_code,
            ],
            'koli_data' => $this->kolies->map(function ($koli) {
                return [
                    // primary
                    'koli_id' => $koli->uuid,
                    // foreign
                    'koli_formula_id' => $koli->formula_id,
                    'package_id' => $koli->package_id,
                    'connote_id' => $koli->connote_id,
                    // column
                    'koli_length' => $koli->length,
                    'awb_url' => $koli->awb_url,
                    'koli_chargeable_weight' => $koli->chargeable_weight,
                    'koli_width' => $koli->width,
                    'koli_surcharge' => json_decode($koli->surcharge),
                    'koli_height' => $koli->height,
                    'koli_description' => $koli->description,
                    'koli_volume' => $koli->volume,
                    'koli_weight' => $koli->weight,
                    'koli_code' => $koli->code,
                    // timestamp
                    'created_at' => $koli->created_at,
                    'updated_at' => $koli->updated_at,
                    'koli_custom_field' => [
                        'awb_sicepat' => $koli->koli_custom_field->awb_sicepat,
                        'price' => $koli->koli_custom_field->price,
                    ],
                ];
            }),
            'custom_field' => [
                'catatan_tambahan' => $this->custom_field->note
            ],
            'currentLocation' => [
                'name' => $this->current_location->name,
                'code' => $this->current_location->code,
                'type' => $this->current_location->type,
            ],
        ];
    }
}
