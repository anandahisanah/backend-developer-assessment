<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\PatchRequest;
use App\Http\Requests\PutRequest;
use App\Http\Resources\PackageResource;
use App\Models\Connote;
use App\Models\CurrentLocation;
use App\Models\Customer;
use App\Models\CustomerAttribute;
use App\Models\CustomField;
use App\Models\Koli;
use App\Models\KoliCustomField;
use App\Models\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * GET package
     *
     * Return an array of all package data.
     *
     */
    public function get()
    {
        try {
            $package = PackageResource::collection(Package::with([
                'customer_attribute',
                'connote',
                'customer_origin',
                'customer_destination',
                'kolies.koli_custom_field',
                'custom_field',
                'current_location',
            ])->get());

            return response()->json([
                'status' => 'success',
                'message' => 'Success',
                'data' => $package,
            ]);
        } catch (\Throwable) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found',
                'data' => null,
            ]);
        }
    }


    /**
     * GET package/{uuid}
     *
     * Return package data with uuid parameter.
     *
     * @urlParam uuid string Example: your-uuid-string
     *
     */
    public function first($uuid)
    {
        try {
            $package = PackageResource::make(Package::where('uuid', $uuid)->with([
                'customer_attribute',
                'connote',
                'customer_origin',
                'customer_destination',
                'kolies.koli_custom_field',
                'custom_field',
                'current_location',
            ])->first());

            return response()->json([
                'status' => 'success',
                'message' => 'Success',
                'data' => $package,
            ]);
        } catch (\Throwable) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found',
                'data' => null,
            ]);
        }
    }

    /**
     * POST package
     *
     * Create new package.
     *
     * @urlParam uuid string Example: your-uuid-string
     *
     */
    public function create(CreateRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            // validate request
            $request->validated();

            // create customer attribute
            $customer_attribute = CustomerAttribute::create([
                'sales_name' => $request->customer_attribute['sales_name'],
                'top' => $request->customer_attribute['top'],
                'type' => $request->customer_attribute['type'],
            ]);

            // create connote
            $connote = Connote::create([
                // primary
                'uuid' => $request->connote['connote_id'],
                // foreign
                'connote_state_id' => $request->connote['connote_state_id'],
                'transaction_id' => $request->connote['transaction_id'],
                'organization_id' => $request->connote['organization_id'],
                'location_id' => $request->connote['location_id'],
                // column
                'connote_number' => $request->connote['connote_number'],
                'connote_service' => $request->connote['connote_service'],
                'connote_service_price' => $request->connote['connote_service_price'],
                'connote_amount' => $request->connote['connote_amount'],
                'connote_code' => $request->connote['connote_code'],
                'connote_booking_code' => $request->connote['connote_booking_code'],
                'connote_order' => $request->connote['connote_order'],
                'connote_state' => $request->connote['connote_state'],
                'zone_code_from' => $request->connote['zone_code_from'],
                'zone_code_to' => $request->connote['zone_code_to'],
                'surcharge_amount' => $request->connote['surcharge_amount'],
                'actual_weight' => $request->connote['actual_weight'],
                'volume_weight' => $request->connote['volume_weight'],
                'chargeable_weight' => $request->connote['chargeable_weight'],
                'connote_total_package' => $request->connote['connote_total_package'],
                'connote_surcharge_amount' => $request->connote['connote_surcharge_amount'],
                'connote_sla_day' => $request->connote['connote_sla_day'],
                'location_name' => $request->connote['location_name'],
                'location_type' => $request->connote['location_type'],
                'source_tariff_db' => $request->connote['source_tariff_db'],
                'id_source_tariff' => $request->connote['id_source_tariff'],
                'pod' => $request->connote['pod'],
                'history' => json_encode($request->connote['history']),
            ]);

            // create customer origin
            $customer_origin = Customer::create([
                // foreign
                'organization_id' => $request->origin_data['organization_id'],
                'location_id' => $request->origin_data['location_id'],
                // column
                'type' => 'origin',
                'customer_name' => $request->origin_data['customer_name'],
                'customer_address' => $request->origin_data['customer_address'],
                'customer_email' => $request->origin_data['customer_email'],
                'customer_phone' => $request->origin_data['customer_phone'],
                'customer_address_detail' => $request->origin_data['customer_address_detail'],
                'customer_zip_code' => $request->origin_data['customer_zip_code'],
                'zone_code' => $request->origin_data['zone_code'],
            ]);

            // create customer destination
            $customer_destination = Customer::create([
                // foreign
                'organization_id' => $request->destination_data['organization_id'],
                'location_id' => $request->destination_data['location_id'],
                // column
                'type' => 'destination',
                'customer_name' => $request->origin_data['customer_name'],
                'customer_address' => $request->origin_data['customer_address'],
                'customer_email' => $request->origin_data['customer_email'],
                'customer_phone' => $request->origin_data['customer_phone'],
                'customer_address_detail' => $request->origin_data['customer_address_detail'],
                'customer_zip_code' => $request->origin_data['customer_zip_code'],
                'zone_code' => $request->origin_data['zone_code'],
            ]);

            // create custom field
            $custom_field = CustomField::create([
                // column
                'note' => $request->custom_field['note']
            ]);

            // create current location
            $current_location = CurrentLocation::create([
                // column
                'name' => $request->current_location['name'],
                'code' => $request->current_location['code'],
                'type' => $request->current_location['type'],
            ]);

            // create package
            $package = Package::create([
                // foreign
                'transaction_id' => $request->transaction_id,
                'location_id' => $request->location_id,
                'organization_id' => $request->organization_id,
                'customer_attribute_id' => $customer_attribute->id,
                'connote_id' => $connote->id,
                'customer_origin_id' => $customer_origin->id,
                'customer_destination_id' => $customer_destination->id,
                'custom_field_id' => $custom_field->id,
                'current_location_id' => $current_location->id,
                // column
                'customer_name' => $request->customer_name,
                'customer_code' => $request->customer_code,
                'transaction_amount' => $request->transaction_amount,
                'transaction_discount' => $request->transaction_discount,
                'transaction_additional_field' => $request->transaction_additional_field,
                'transaction_payment_type' => $request->transaction_payment_type,
                'transaction_state' => $request->transaction_state,
                'transaction_code' => $request->transaction_code,
                'transaction_order' => $request->transaction_order,
                'transaction_payment_type_name' => $request->transaction_payment_type_name,
                'transaction_cash_amount' => $request->transaction_cash_amount,
                'transaction_cash_change' => $request->transaction_cash_change,
            ]);

            foreach ($request->kolies as $request_koli) {
                $koli_custom_field = KoliCustomField::create([
                    // column
                    'awb_sicepat' => $request_koli['koli_custom_field']['awb_sicepat'],
                    'price' => $request_koli['koli_custom_field']['price'],
                ]);

                Koli::create([
                    // foreign
                    'formula_id' => $request_koli['koli_formula_id'],
                    'package_id' => $package->id,
                    'connote_id' => $connote->id,
                    'koli_custom_field_id' => $koli_custom_field->id,
                    // column
                    'length' => $request_koli['koli_length'],
                    'awb_url' => $request_koli['awb_url'],
                    'chargeable_weight' => $request_koli['koli_chargeable_weight'],
                    'width' => $request_koli['koli_width'],
                    'surcharge' => json_encode($request_koli['koli_surcharge']),
                    'height' => $request_koli['koli_height'],
                    'description' => $request_koli['koli_description'],
                    'volume' => $request_koli['koli_volume'],
                    'weight' => $request_koli['koli_weight'],
                    'code' => $request_koli['koli_code'],
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ]);
        }
    }

    /**
     * PUT package/{uuid}
     *
     * Update an existing package.
     *
     * @urlParam uuid string Example: your-uuid-string
     *
     */
    public function put(PutRequest $request, $uuid): JsonResponse
    {
        try {
            DB::beginTransaction();

            // validate request
            $request->validated();

            // find package
            $package = Package::where('uuid', $uuid)->first();

            // update customer attribute
            CustomerAttribute::where('id', $package->customer_attribute->id)->first()->update([
                'sales_name' => $request->customer_attribute['sales_name'],
                'top' => $request->customer_attribute['top'],
                'type' => $request->customer_attribute['type'],
            ]);

            // update connote
            Connote::where('id', $package->connote->id)->first()->update([
                // primary
                'uuid' => $request->connote['connote_id'],
                // foreign
                'connote_state_id' => $request->connote['connote_state_id'],
                'transaction_id' => $request->connote['transaction_id'],
                'organization_id' => $request->connote['organization_id'],
                'location_id' => $request->connote['location_id'],
                // column
                'connote_number' => $request->connote['connote_number'],
                'connote_service' => $request->connote['connote_service'],
                'connote_service_price' => $request->connote['connote_service_price'],
                'connote_amount' => $request->connote['connote_amount'],
                'connote_code' => $request->connote['connote_code'],
                'connote_booking_code' => $request->connote['connote_booking_code'],
                'connote_order' => $request->connote['connote_order'],
                'connote_state' => $request->connote['connote_state'],
                'zone_code_from' => $request->connote['zone_code_from'],
                'zone_code_to' => $request->connote['zone_code_to'],
                'surcharge_amount' => $request->connote['surcharge_amount'],
                'actual_weight' => $request->connote['actual_weight'],
                'volume_weight' => $request->connote['volume_weight'],
                'chargeable_weight' => $request->connote['chargeable_weight'],
                'connote_total_package' => $request->connote['connote_total_package'],
                'connote_surcharge_amount' => $request->connote['connote_surcharge_amount'],
                'connote_sla_day' => $request->connote['connote_sla_day'],
                'location_name' => $request->connote['location_name'],
                'location_type' => $request->connote['location_type'],
                'source_tariff_db' => $request->connote['source_tariff_db'],
                'id_source_tariff' => $request->connote['id_source_tariff'],
                'pod' => $request->connote['pod'],
                'history' => json_encode($request->connote['history']),
            ]);

            // update customer origin
            Customer::where('id', $package->customer_origin->id)->first()->update([
                // foreign
                'organization_id' => $request->origin_data['organization_id'],
                'location_id' => $request->origin_data['location_id'],
                // column
                'type' => 'origin',
                'customer_name' => $request->origin_data['customer_name'],
                'customer_address' => $request->origin_data['customer_address'],
                'customer_email' => $request->origin_data['customer_email'],
                'customer_phone' => $request->origin_data['customer_phone'],
                'customer_address_detail' => $request->origin_data['customer_address_detail'],
                'customer_zip_code' => $request->origin_data['customer_zip_code'],
                'zone_code' => $request->origin_data['zone_code'],
            ]);

            // update customer destination
            Customer::where('id', $package->customer_destination->id)->first()->update([
                // foreign
                'organization_id' => $request->destination_data['organization_id'],
                'location_id' => $request->destination_data['location_id'],
                // column
                'type' => 'destination',
                'customer_name' => $request->origin_data['customer_name'],
                'customer_address' => $request->origin_data['customer_address'],
                'customer_email' => $request->origin_data['customer_email'],
                'customer_phone' => $request->origin_data['customer_phone'],
                'customer_address_detail' => $request->origin_data['customer_address_detail'],
                'customer_zip_code' => $request->origin_data['customer_zip_code'],
                'zone_code' => $request->origin_data['zone_code'],
            ]);

            // update custom field
            CustomField::where('id', $package->custom_field->id)->first()->update([
                // column
                'note' => $request->custom_field['note']
            ]);

            // update current location
            CurrentLocation::where('id', $package->current_location->id)->first()->update([
                // column
                'name' => $request->current_location['name'],
                'code' => $request->current_location['code'],
                'type' => $request->current_location['type'],
            ]);

            foreach ($request->kolies as $request_koli) {
                // find koli
                $koli = Koli::where('code', $request_koli['koli_code'])->first();

                // update koli custom field
                KoliCustomField::find($koli->koli_custom_field->id)->update([
                    // column
                    'awb_sicepat' => $request_koli['koli_custom_field']['awb_sicepat'],
                    'price' => $request_koli['koli_custom_field']['price'],
                ]);

                // update koli
                $koli->update([
                    // foreign
                    'formula_id' => $request_koli['koli_formula_id'],
                    // column
                    'length' => $request_koli['koli_length'],
                    'awb_url' => $request_koli['awb_url'],
                    'chargeable_weight' => $request_koli['koli_chargeable_weight'],
                    'width' => $request_koli['koli_width'],
                    'surcharge' => json_encode($request_koli['koli_surcharge']),
                    'height' => $request_koli['koli_height'],
                    'description' => $request_koli['koli_description'],
                    'volume' => $request_koli['koli_volume'],
                    'weight' => $request_koli['koli_weight'],
                    'code' => $request_koli['koli_code'],
                ]);
            }

            // update package
            $package->update([
                // foreign
                'transaction_id' => $request->transaction_id,
                'location_id' => $request->location_id,
                'organization_id' => $request->organization_id,
                // column
                'customer_name' => $request->customer_name,
                'customer_code' => $request->customer_code,
                'transaction_amount' => $request->transaction_amount,
                'transaction_discount' => $request->transaction_discount,
                'transaction_additional_field' => $request->transaction_additional_field,
                'transaction_payment_type' => $request->transaction_payment_type,
                'transaction_state' => $request->transaction_state,
                'transaction_code' => $request->transaction_code,
                'transaction_order' => $request->transaction_order,
                'transaction_payment_type_name' => $request->transaction_payment_type_name,
                'transaction_cash_amount' => $request->transaction_cash_amount,
                'transaction_cash_change' => $request->transaction_cash_change,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ]);
        }
    }

    /**
     * PATCH package/{uuid}
     *
     * Partially update a package.
     *
     * @urlParam uuid string Example: your-uuid-string
     *
     */
    public function patch(PatchRequest $request, $uuid): JsonResponse
    {
        try {
            DB::beginTransaction();

            // validate request
            $request->validated();

            // find package
            $package = Package::where('uuid', $uuid)->first();

            // update package
            $package->update([
                // column
                'transaction_state' => $request->transaction_state,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ]);
        }
    }

    /**
     * DELETE package/{uuid}
     *
     * Deletes an existing package.
     *
     * @urlParam uuid string Example: your-uuid-string
     *
     */
    public function delete($uuid): JsonResponse
    {
        try {
            DB::beginTransaction();

            // find package
            $package = Package::where('uuid', $uuid)->first();

            $customer_attribute_id = $package->customer_attribute->id;
            $connote_id = $package->connote->id;
            $customer_origin_id = $package->customer_origin->id;
            $customer_destination_id = $package->customer_destination->id;
            $custom_field_id = $package->custom_field->id;
            $current_location_id = $package->current_location->id;

            // delete relation kolies->koli_custom_field
            $package->kolies->each(function ($koli) {
                $koli_custom_field_id = $koli->koli_custom_field->id;

                // delete relation koli
                $koli->delete();

                // delete relation koli->koli_custom_field_id
                KoliCustomField::where('id', $koli_custom_field_id)->delete();
            });

            // delete package
            $package->delete();

            // delete relation customer_attribute
            CustomerAttribute::find($customer_attribute_id)->delete();

            // delete relation connote
            Connote::find($connote_id)->delete();

            // delete relation customer_origin
            Customer::find($customer_origin_id)->delete();

            // delete relation customer_destination
            Customer::find($customer_destination_id)->delete();

            // delete relation custom_field
            CustomField::find($custom_field_id)->delete();

            // delete relation current_location
            CurrentLocation::find($current_location_id)->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ]);
        }
    }
}
