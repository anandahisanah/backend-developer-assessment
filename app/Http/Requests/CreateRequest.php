<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'transaction_id' => 'required|uuid',
            'customer_name' => 'required|string',
            'customer_code' => 'required|string',
            'transaction_amount' => 'required|string',
            'transaction_discount' => 'required|string',
            'transaction_additional_field' => 'nullable',
            'transaction_payment_type' => 'required|string',
            'transaction_state' => 'required|string',
            'transaction_code' => 'required|string',
            'transaction_order' => 'required|numeric',
            'location_id' => 'required|string',
            'organization_id' => 'required|numeric',
            'transaction_payment_type_name' => 'required|string',
            'transaction_cash_amount' => 'required|numeric',
            'transaction_cash_change' => 'required|numeric',
            'connote_id' => 'required|uuid',
            // cutomer_attribute
            'customer_attribute' => 'required|array',
            'customer_attribute.sales_name' => 'required|string',
            'customer_attribute.top' => 'required|string',
            'customer_attribute.type' => 'required|string',
            // connote
            'connote' => 'required|array',
            'connote.connote_id' => 'required|uuid',
            'connote.connote_number' => 'required|numeric',
            'connote.connote_service' => 'required|string',
            'connote.connote_service_price' => 'required|numeric',
            'connote.connote_amount' => 'required|numeric',
            'connote.connote_code' => 'required|string',
            'connote.connote_booking_code' => 'nullable',
            'connote.connote_order' => 'required|numeric',
            'connote.connote_state' => 'required|string',
            'connote.connote_state_id' => 'required|numeric',
            'connote.zone_code_from' => 'required|string',
            'connote.zone_code_to' => 'required|string',
            'connote.surcharge_amount' => 'nullable',
            'connote.transaction_id' => 'required|uuid',
            'connote.actual_weight' => 'required|numeric',
            'connote.volume_weight' => 'required|numeric',
            'connote.chargeable_weight' => 'required|numeric',
            'connote.organization_id' => 'required|numeric',
            'connote.location_id' => 'required|string',
            'connote.connote_total_package' => 'required|string',
            'connote.connote_surcharge_amount' => 'required|string',
            'connote.connote_sla_day' => 'required|string',
            'connote.location_name' => 'required|string',
            'connote.location_type' => 'required|string',
            'connote.source_tariff_db' => 'required|string',
            'connote.id_source_tariff' => 'required|string',
            'connote.pod' => 'nullable',
            'connote.history' => 'array',
            // origin_data
            'origin_data' => 'required|array',
            'origin_data.customer_name' => 'required|string',
            'origin_data.customer_address' => 'required|string',
            'origin_data.customer_email' => 'nullable|email',
            'origin_data.customer_phone' => 'required|string',
            'origin_data.customer_address_detail' => 'nullable|string',
            'origin_data.customer_zip_code' => 'required|string',
            'origin_data.zone_code' => 'required|string',
            'origin_data.organization_id' => 'required|numeric',
            'origin_data.location_id' => 'required|string',
            // destination_data
            'destination_data' => 'required|array',
            'destination_data.customer_name' => 'required|string',
            'destination_data.customer_address' => 'required|string',
            'destination_data.customer_email' => 'nullable|email',
            'destination_data.customer_phone' => 'required|string',
            'destination_data.customer_address_detail' => 'nullable|string',
            'destination_data.customer_zip_code' => 'required|string',
            'destination_data.zone_code' => 'required|string',
            'destination_data.organization_id' => 'required|numeric',
            'destination_data.location_id' => 'required|string',
            // kolies
            'kolies' => 'required|array',
            'kolies.*.koli_length' => 'required|numeric',
            'kolies.*.awb_url' => 'required|url',
            'kolies.*.koli_chargeable_weight' => 'required|numeric',
            'kolies.*.koli_width' => 'required|numeric',
            'kolies.*.koli_surcharge' => 'array',
            'kolies.*.koli_height' => 'required|numeric',
            'kolies.*.koli_description' => 'required|string',
            'kolies.*.koli_formula_id' => 'nullable',
            'kolies.*.koli_volume' => 'required|numeric',
            'kolies.*.koli_weight' => 'required|numeric',
            'kolies.*.koli_code' => 'required|string',
            'kolies.*.koli_custom_field' => 'array',
            'kolies.*.koli_custom_field.awb_sicepat' => 'nullable',
            'kolies.*.koli_custom_field.price' => 'nullable',
            // custom_field
            'custom_field' => 'required|array',
            'custom_field.note' => 'required|string',
            // current_location
            'current_location' => 'required|array',
            'current_location.name' => 'required|string',
            'current_location.code' => 'required|string|min:3|max:10',
            'current_location.type' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'transaction_id' => 'transaction_id',
            'customer_name' => 'customer_name',
            'customer_code' => 'customer_code',
            'transaction_amount' => 'transaction_amount',
            'transaction_discount' => 'transaction_discount',
            'transaction_additional_field' => 'transaction_additional_field',
            'transaction_payment_type' => 'transaction_payment_type',
            'transaction_state' => 'transaction_state',
            'transaction_code' => 'transaction_code',
            'transaction_order' => 'transaction_order',
            'location_id' => 'location_id',
            'organization_id' => 'organization_id',
            'transaction_payment_type_name' => 'transaction_payment_type_name',
            'transaction_cash_amount' => 'transaction_cash_amount',
            'transaction_cash_change' => 'transaction_cash_change',
            'connote_id' => 'connote_id',
            // cutomer_attribute
            'customer_attribute' => 'customer_attribute',
            'customer_attribute.sales_name' => 'sales_name',
            'customer_attribute.top' => 'top',
            'customer_attribute.type' => 'type',
            // connote
            'connote' => 'connote',
            'connote.connote_id' => 'connote_id',
            'connote.connote_number' => 'connote_number',
            'connote.connote_service' => 'connote_service',
            'connote.connote_service_price' => 'connote_service_price',
            'connote.connote_amount' => 'connote_amount',
            'connote.connote_code' => 'connote_code',
            'connote.connote_booking_code' => 'connote_booking_code',
            'connote.connote_order' => 'connote_order',
            'connote.connote_state' => 'connote_state',
            'connote.connote_state_id' => 'connote_state_id',
            'connote.zone_code_from' => 'zone_code_from',
            'connote.zone_code_to' => 'zone_code_to',
            'connote.surcharge_amount' => 'surcharge_amount',
            'connote.transaction_id' => 'transaction_id',
            'connote.actual_weight' => 'actual_weight',
            'connote.volume_weight' => 'volume_weight',
            'connote.chargeable_weight' => 'chargeable_weight',
            'connote.organization_id' => 'organization_id',
            'connote.location_id' => 'location_id',
            'connote.connote_total_package' => 'connote_total_package',
            'connote.connote_surcharge_amount' => 'connote_surcharge_amount',
            'connote.connote_sla_day' => 'connote_sla_day',
            'connote.location_name' => 'location_name',
            'connote.location_type' => 'location_type',
            'connote.source_tariff_db' => 'source_tariff_db',
            'connote.id_source_tariff' => 'id_source_tariff',
            'connote.pod' => 'pod',
            'connote.history' => 'history',
            // origin_data
            'origin_data' => 'origin_data',
            'origin_data.customer_name' => 'customer_name',
            'origin_data.customer_address' => 'customer_address',
            'origin_data.customer_email' => 'customer_email',
            'origin_data.customer_phone' => 'customer_phone',
            'origin_data.customer_address_detail' => 'customer_address_detail',
            'origin_data.customer_zip_code' => 'customer_zip_code',
            'origin_data.zone_code' => 'zone_code',
            'origin_data.organization_id' => 'organization_id',
            'origin_data.location_id' => 'location_id',
            // destination_data
            'destination_data' => 'destination_data',
            'destination_data.customer_name' => 'customer_name',
            'destination_data.customer_address' => 'customer_address',
            'destination_data.customer_email' => 'customer_email',
            'destination_data.customer_phone' => 'customer_phone',
            'destination_data.customer_address_detail' => 'customer_address_detail',
            'destination_data.customer_zip_code' => 'customer_zip_code',
            'destination_data.zone_code' => 'zone_code',
            'destination_data.organization_id' => 'organization_id',
            'destination_data.location_id' => 'location_id',
            // kolies
            'kolies' => 'kolies',
            'kolies.*.koli_length' => 'koli_length',
            'kolies.*.awb_url' => 'awb_url',
            'kolies.*.koli_chargeable_weight' => 'koli_chargeable_weight',
            'kolies.*.koli_width' => 'koli_width',
            'kolies.*.koli_surcharge' => 'koli_surcharge',
            'kolies.*.koli_height' => 'koli_height',
            'kolies.*.koli_description' => 'koli_description',
            'kolies.*.koli_formula_id' => 'koli_formula_id',
            'kolies.*.koli_volume' => 'koli_volume',
            'kolies.*.koli_weight' => 'koli_weight',
            'kolies.*.koli_code' => 'koli_code',
            'kolies.*.koli_custom_field' => 'koli_custom_field',
            'kolies.*.koli_custom_field.awb_sicepat' => 'awb_sicepat',
            'kolies.*.koli_custom_field.price' => 'price',
            // custom_field
            'custom_field' => 'custom_field',
            'custom_field.note' => 'note',
            // current_location
            'current_location' => 'current_location',
            'current_location.name' => 'name',
            'current_location.code' => 'code',
            'current_location.type' => 'type',
        ];
    }
}
