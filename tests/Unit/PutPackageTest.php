<?php

namespace Tests\Unit;

use App\Models\Connote;
use App\Models\CurrentLocation;
use App\Models\Customer;
use App\Models\CustomerAttribute;
use App\Models\CustomField;
use App\Models\Koli;
use App\Models\KoliCustomField;
use App\Models\Package;
use Faker\Factory as FakerFactory;
use Tests\TestCase;

class PutPackageTest extends TestCase
{
    public function test_update_customer_attribute(): void
    {
        $data = [
            // column
            'sales_name' => 'Radit Fitrawikarsa',
            'top' => '14 Hari',
            'type' => 'B2B',
        ];

        // find package
        $package = Package::first();

        // update
        $customer_attribute = CustomerAttribute::find($package->customer_attribute->id);
        $customer_attribute->update($data);

        $updated_customer_attribute = CustomerAttribute::find($customer_attribute->id);

        $this->assertInstanceOf(CustomerAttribute::class, $updated_customer_attribute);
        $this->assertEquals($data['sales_name'], $updated_customer_attribute->sales_name);
        $this->assertEquals($data['top'], $updated_customer_attribute->top);
        $this->assertEquals($data['type'], $updated_customer_attribute->type);
    }

    public function test_update_connote(): void
    {
        $faker = FakerFactory::create();

        $data = [
            // primary
            'uuid' => $faker->uuid,
            // foreign
            'connote_state_id' => 2,
            'transaction_id' => 'd0090c40-539f-479a-8274-899b9970bddc',
            'organization_id' => 6,
            'location_id' => '5cecb20b6c49615b174c3e74',
            // column
            'connote_number' => 1,
            'connote_service' => 'ECO',
            'connote_service_price' => 70700,
            'connote_amount' => 70700,
            'connote_code' => 'AWB00100209082020',
            'connote_booking_code' => null,
            'connote_order' => 326931,
            'connote_state' => 'PAID',
            'zone_code_from' => 'CGKFT',
            'zone_code_to' => 'SMG',
            'surcharge_amount' => null,
            'actual_weight' => 20,
            'volume_weight' => 0,
            'chargeable_weight' => 20,
            'connote_total_package' => '3',
            'connote_surcharge_amount' => '0',
            'connote_sla_day' => '4',
            'location_name' => 'Hub Jakarta Selatan',
            'location_type' => 'HUB',
            'source_tariff_db' => 'tariff_customers',
            'id_source_tariff' => '1576868',
            'pod' => null,
            'history' => json_encode([]),
        ];

        // find package
        $package = Package::first();

        // update
        $connote = Connote::find($package->connote->id);
        $connote->update($data);

        $updated_connote = Connote::find($connote->id);

        $this->assertInstanceOf(Connote::class, $updated_connote);
        $this->assertEquals($data['uuid'], $updated_connote->uuid);
        $this->assertEquals($data['connote_state_id'], $updated_connote->connote_state_id);
        $this->assertEquals($data['transaction_id'], $updated_connote->transaction_id);
        $this->assertEquals($data['organization_id'], $updated_connote->organization_id);
        $this->assertEquals($data['location_id'], $updated_connote->location_id);
        $this->assertEquals($data['connote_number'], $updated_connote->connote_number);
        $this->assertEquals($data['connote_service'], $updated_connote->connote_service);
        $this->assertEquals($data['connote_service_price'], $updated_connote->connote_service_price);
        $this->assertEquals($data['connote_amount'], $updated_connote->connote_amount);
        $this->assertEquals($data['connote_code'], $updated_connote->connote_code);
        $this->assertEquals($data['connote_booking_code'], $updated_connote->connote_booking_code);
        $this->assertEquals($data['connote_order'], $updated_connote->connote_order);
        $this->assertEquals($data['connote_state'], $updated_connote->connote_state);
        $this->assertEquals($data['zone_code_from'], $updated_connote->zone_code_from);
        $this->assertEquals($data['zone_code_to'], $updated_connote->zone_code_to);
        $this->assertEquals($data['surcharge_amount'], $updated_connote->surcharge_amount);
        $this->assertEquals($data['actual_weight'], $updated_connote->actual_weight);
        $this->assertEquals($data['volume_weight'], $updated_connote->volume_weight);
        $this->assertEquals($data['chargeable_weight'], $updated_connote->chargeable_weight);
        $this->assertEquals($data['connote_total_package'], $updated_connote->connote_total_package);
        $this->assertEquals($data['connote_surcharge_amount'], $updated_connote->connote_surcharge_amount);
        $this->assertEquals($data['connote_sla_day'], $updated_connote->connote_sla_day);
        $this->assertEquals($data['location_name'], $updated_connote->location_name);
        $this->assertEquals($data['location_type'], $updated_connote->location_type);
        $this->assertEquals($data['source_tariff_db'], $updated_connote->source_tariff_db);
        $this->assertEquals($data['id_source_tariff'], $updated_connote->id_source_tariff);
        $this->assertEquals($data['pod'], $updated_connote->pod);
        $this->assertEquals($data['history'], $updated_connote->history);
    }

    public function test_update_customer_type_origin(): void
    {
        $data = [
            // foreign
            'organization_id' => 6,
            'location_id' => '5cecb20b6c49615b174c3e74',
            // column
            'type' => 'origin',
            'customer_name' => 'PT. NARA OKA PRAKARSA',
            'customer_address' => 'JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420',
            'customer_email' => 'info@naraoka.co.id',
            'customer_phone' => '024-1234567',
            'customer_address_detail' => null,
            'customer_zip_code' => '12420',
            'zone_code' => 'CGKFT',
        ];

        // find package
        $package = Package::first();

        // update
        $customer = Customer::find($package->customer_origin->id);
        $customer->update($data);

        $updated_customer = Customer::find($customer->id);

        $this->assertInstanceOf(Customer::class, $updated_customer);
        $this->assertEquals($data['organization_id'], $updated_customer->organization_id);
        $this->assertEquals($data['location_id'], $updated_customer->location_id);
        $this->assertEquals('origin', $updated_customer->type);
        $this->assertEquals($data['customer_name'], $updated_customer->customer_name);
        $this->assertEquals($data['customer_address'], $updated_customer->customer_address);
        $this->assertEquals($data['customer_email'], $updated_customer->customer_email);
        $this->assertEquals($data['customer_phone'], $updated_customer->customer_phone);
        $this->assertEquals($data['customer_address_detail'], $updated_customer->customer_address_detail);
        $this->assertEquals($data['customer_zip_code'], $updated_customer->customer_zip_code);
        $this->assertEquals($data['zone_code'], $updated_customer->zone_code);
    }

    public function test_update_customer_type_destination(): void
    {
        $data = [
            // foreign
            'organization_id' => 6,
            'location_id' => '5cecb20b6c49615b174c3e74',
            // column
            'type' => 'destination',
            'customer_name' => 'PT AMARIS HOTEL SIMPANG LIMA',
            'customer_address' => 'JL. KH. AHMAD DAHLAN NO. 01, SEMARANG TENGAH',
            'customer_email' => null,
            'customer_phone' => '0248453499',
            'customer_address_detail' => 'KOTA SEMARANG SEMARANG TENGAH KARANGKIDUL',
            'customer_zip_code' => '50241',
            'zone_code' => 'SMG',
        ];

        // find package
        $package = Package::first();

        // update
        $customer = Customer::find($package->customer_destination->id);
        $customer->update($data);

        $updated_customer = Customer::find($customer->id);

        $this->assertInstanceOf(Customer::class, $updated_customer);
        $this->assertEquals($data['organization_id'], $updated_customer->organization_id);
        $this->assertEquals($data['location_id'], $updated_customer->location_id);
        $this->assertEquals('destination', $updated_customer->type);
        $this->assertEquals($data['customer_name'], $updated_customer->customer_name);
        $this->assertEquals($data['customer_address'], $updated_customer->customer_address);
        $this->assertEquals($data['customer_email'], $updated_customer->customer_email);
        $this->assertEquals($data['customer_phone'], $updated_customer->customer_phone);
        $this->assertEquals($data['customer_address_detail'], $updated_customer->customer_address_detail);
        $this->assertEquals($data['customer_zip_code'], $updated_customer->customer_zip_code);
        $this->assertEquals($data['zone_code'], $updated_customer->zone_code);
    }

    public function test_update_custom_field(): void
    {
        $data = [
            // column
            'note' => 'JANGAN DI BANTING / DI TINDIH',
        ];

        // find package
        $package = Package::first();

        // update
        $custom_field = CustomField::find($package->custom_field->id);
        $custom_field->update($data);

        $updated_custom_field = CustomField::find($custom_field->id);

        $this->assertInstanceOf(CustomField::class, $updated_custom_field);
        $this->assertEquals($data['note'], $updated_custom_field->note);
    }

    public function test_update_current_location(): void
    {
        $data = [
            // column
            'name' => 'Hub Jakarta Selatan',
            'code' => 'JKTS01',
            'type' => 'Agent',
        ];

        // find package
        $package = Package::first();

        // update
        $current_location = CurrentLocation::find($package->current_location->id);
        $current_location->update($data);

        $updated_current_location = CurrentLocation::find($current_location->id);

        $this->assertInstanceOf(CurrentLocation::class, $updated_current_location);
        $this->assertEquals($data['name'], $updated_current_location->name);
        $this->assertEquals($data['code'], $updated_current_location->code);
        $this->assertEquals($data['type'], $updated_current_location->type);
    }

    public function test_update_package(): void
    {
        $data = [
            // foreign
            'transaction_id' => 'd0090c40-539f-479a-8274-899b9970bddc',
            'location_id' => 'd0090c40-539f-479a-8274-899b9970bddc',
            'organization_id' => 6,
            'customer_attribute_id' => CustomerAttribute::first()->id,
            'connote_id' => Connote::first()->id,
            'customer_origin_id' => Customer::where('type', 'origin')->first()->id,
            'customer_destination_id' => Customer::where('type', 'destination')->first()->id,
            'custom_field_id' => CustomField::first()->id,
            'current_location_id' => CurrentLocation::first()->id,
            // column
            'customer_name' => 'PT. AMARA PRIMATIGA',
            'customer_code' => '1678593',
            'transaction_amount' => '70700',
            'transaction_discount' => '0',
            'transaction_additional_field' => null,
            'transaction_payment_type' => '29',
            'transaction_state' => 'PAID',
            'transaction_code' => 'CGKFT20200715121',
            'transaction_order' => 121,
            'transaction_payment_type_name' => 'Invoice',
            'transaction_cash_amount' => 0,
            'transaction_cash_change' => 0,
        ];

        // find package
        $package = Package::first();

        // update
        $package->update($data);

        $updated_package = Package::find($package->id);

        $this->assertInstanceOf(Package::class, $updated_package);
        $this->assertEquals($data['transaction_id'], $updated_package->transaction_id);
        $this->assertEquals($data['location_id'], $updated_package->location_id);
        $this->assertEquals($data['organization_id'], $updated_package->organization_id);
        $this->assertEquals($data['customer_attribute_id'], $updated_package->customer_attribute_id);
        $this->assertEquals($data['connote_id'], $updated_package->connote_id);
        $this->assertEquals($data['customer_origin_id'], $updated_package->customer_origin_id);
        $this->assertEquals($data['customer_destination_id'], $updated_package->customer_destination_id);
        $this->assertEquals($data['custom_field_id'], $updated_package->custom_field_id);
        $this->assertEquals($data['current_location_id'], $updated_package->current_location_id);
        $this->assertEquals($data['customer_name'], $updated_package->customer_name);
        $this->assertEquals($data['customer_code'], $updated_package->customer_code);
        $this->assertEquals($data['transaction_amount'], $updated_package->transaction_amount);
        $this->assertEquals($data['transaction_discount'], $updated_package->transaction_discount);
        $this->assertEquals($data['transaction_additional_field'], $updated_package->transaction_additional_field);
        $this->assertEquals($data['transaction_payment_type'], $updated_package->transaction_payment_type);
        $this->assertEquals($data['transaction_state'], $updated_package->transaction_state);
        $this->assertEquals($data['transaction_code'], $updated_package->transaction_code);
        $this->assertEquals($data['transaction_order'], $updated_package->transaction_order);
        $this->assertEquals($data['transaction_payment_type_name'], $updated_package->transaction_payment_type_name);
        $this->assertEquals($data['transaction_cash_amount'], $updated_package->transaction_cash_amount);
        $this->assertEquals($data['transaction_cash_change'], $updated_package->transaction_cash_change);
    }

    public function test_update_koli_and_koli_custom_field(): void
    {
        // find koli
        $koli = Koli::first();

        $data = [
            // column
            'awb_sicepat' => null,
            'price' => null,
        ];

        // update koli custom field
        KoliCustomField::find($koli->koli_custom_field->id)->update($data);

        $updated_koli_custom_field = KoliCustomField::find($koli->koli_custom_field->id);

        $this->assertInstanceOf(KoliCustomField::class, $updated_koli_custom_field);
        $this->assertEquals($data['awb_sicepat'], $updated_koli_custom_field->awb_sicepat);
        $this->assertEquals($data['price'], $updated_koli_custom_field->price);

        $data = [
            // foreign
            'formula_id' => null,
            // column
            'length' => 0,
            'awb_url' => 'https://tracking.mile.app/label/AWB00100209082020.1',
            'chargeable_weight' => 9,
            'width' => 0,
            'surcharge' => json_encode([]),
            'height' => 0,
            'description' => 'V WARP',
            'volume' => 0,
            'weight' => 9,
            'code' => 'AWB00100209082020.1',
        ];

        // update koli
        $koli->update($data);

        $updated_koli = Koli::find($koli->id);

        $this->assertInstanceOf(Koli::class, $updated_koli);
        $this->assertEquals($data['formula_id'], $updated_koli->formula_id);
        $this->assertEquals($data['length'], $updated_koli->length);
        $this->assertEquals($data['awb_url'], $updated_koli->awb_url);
        $this->assertEquals($data['chargeable_weight'], $updated_koli->chargeable_weight);
        $this->assertEquals($data['width'], $updated_koli->width);
        $this->assertEquals($data['surcharge'], $updated_koli->surcharge);
        $this->assertEquals($data['height'], $updated_koli->height);
        $this->assertEquals($data['description'], $updated_koli->description);
        $this->assertEquals($data['volume'], $updated_koli->volume);
        $this->assertEquals($data['weight'], $updated_koli->weight);
        $this->assertEquals($data['code'], $updated_koli->code);
    }
}
