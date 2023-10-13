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
}
