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

class CreatePackageTest extends TestCase
{
    public function test_create_customer_attribute(): void
    {
        $data = [
            // column
            'sales_name' => 'Radit Fitrawikarsa',
            'top' => '14 Hari',
            'type' => 'B2B',
        ];

        $customer_attribute = CustomerAttribute::create($data);

        $this->assertInstanceOf(CustomerAttribute::class, $customer_attribute);
        $this->assertEquals($data['sales_name'], $customer_attribute->sales_name);
        $this->assertEquals($data['top'], $customer_attribute->top);
        $this->assertEquals($data['type'], $customer_attribute->type);
    }

    public function test_create_connote(): void
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

        $connote = Connote::create($data);

        $this->assertInstanceOf(Connote::class, $connote);
        $this->assertEquals($data['uuid'], $connote->uuid);
        $this->assertEquals($data['connote_state_id'], $connote->connote_state_id);
        $this->assertEquals($data['transaction_id'], $connote->transaction_id);
        $this->assertEquals($data['organization_id'], $connote->organization_id);
        $this->assertEquals($data['location_id'], $connote->location_id);
        $this->assertEquals($data['connote_number'], $connote->connote_number);
        $this->assertEquals($data['connote_service'], $connote->connote_service);
        $this->assertEquals($data['connote_service_price'], $connote->connote_service_price);
        $this->assertEquals($data['connote_amount'], $connote->connote_amount);
        $this->assertEquals($data['connote_code'], $connote->connote_code);
        $this->assertEquals($data['connote_booking_code'], $connote->connote_booking_code);
        $this->assertEquals($data['connote_order'], $connote->connote_order);
        $this->assertEquals($data['connote_state'], $connote->connote_state);
        $this->assertEquals($data['zone_code_from'], $connote->zone_code_from);
        $this->assertEquals($data['zone_code_to'], $connote->zone_code_to);
        $this->assertEquals($data['surcharge_amount'], $connote->surcharge_amount);
        $this->assertEquals($data['actual_weight'], $connote->actual_weight);
        $this->assertEquals($data['volume_weight'], $connote->volume_weight);
        $this->assertEquals($data['chargeable_weight'], $connote->chargeable_weight);
        $this->assertEquals($data['connote_total_package'], $connote->connote_total_package);
        $this->assertEquals($data['connote_surcharge_amount'], $connote->connote_surcharge_amount);
        $this->assertEquals($data['connote_sla_day'], $connote->connote_sla_day);
        $this->assertEquals($data['location_name'], $connote->location_name);
        $this->assertEquals($data['location_type'], $connote->location_type);
        $this->assertEquals($data['source_tariff_db'], $connote->source_tariff_db);
        $this->assertEquals($data['id_source_tariff'], $connote->id_source_tariff);
        $this->assertEquals($data['pod'], $connote->pod);
        $this->assertEquals($data['history'], $connote->history);
    }

    public function test_create_customer_type_origin(): void
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

        $customer = Customer::create($data);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals($data['organization_id'], $customer->organization_id);
        $this->assertEquals($data['location_id'], $customer->location_id);
        $this->assertEquals('origin', $customer->type);
        $this->assertEquals($data['customer_name'], $customer->customer_name);
        $this->assertEquals($data['customer_address'], $customer->customer_address);
        $this->assertEquals($data['customer_email'], $customer->customer_email);
        $this->assertEquals($data['customer_phone'], $customer->customer_phone);
        $this->assertEquals($data['customer_address_detail'], $customer->customer_address_detail);
        $this->assertEquals($data['customer_zip_code'], $customer->customer_zip_code);
        $this->assertEquals($data['zone_code'], $customer->zone_code);
    }

    public function test_create_customer_type_destination(): void
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

        $customer = Customer::create($data);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals($data['organization_id'], $customer->organization_id);
        $this->assertEquals($data['location_id'], $customer->location_id);
        $this->assertEquals('destination', $customer->type);
        $this->assertEquals($data['customer_name'], $customer->customer_name);
        $this->assertEquals($data['customer_address'], $customer->customer_address);
        $this->assertEquals($data['customer_email'], $customer->customer_email);
        $this->assertEquals($data['customer_phone'], $customer->customer_phone);
        $this->assertEquals($data['customer_address_detail'], $customer->customer_address_detail);
        $this->assertEquals($data['customer_zip_code'], $customer->customer_zip_code);
        $this->assertEquals($data['zone_code'], $customer->zone_code);
    }

    public function test_create_custom_field(): void
    {
        $data = [
            // column
            'note' => 'JANGAN DI BANTING / DI TINDIH',
        ];

        $custom_field = CustomField::create($data);

        $this->assertInstanceOf(CustomField::class, $custom_field);
        $this->assertEquals($data['note'], $custom_field->note);
    }

    public function test_create_current_location(): void
    {
        $data = [
            // column
            'name' => 'Hub Jakarta Selatan',
            'code' => 'JKTS01',
            'type' => 'Agent',
        ];

        $current_location = CurrentLocation::create($data);

        $this->assertInstanceOf(CurrentLocation::class, $current_location);
        $this->assertEquals($data['name'], $current_location->name);
        $this->assertEquals($data['code'], $current_location->code);
        $this->assertEquals($data['type'], $current_location->type);
    }

    public function test_create_package(): void
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

        $package = Package::create($data);

        $this->assertInstanceOf(Package::class, $package);
        $this->assertEquals($data['transaction_id'], $package->transaction_id);
        $this->assertEquals($data['location_id'], $package->location_id);
        $this->assertEquals($data['organization_id'], $package->organization_id);
        $this->assertEquals($data['customer_attribute_id'], $package->customer_attribute_id);
        $this->assertEquals($data['connote_id'], $package->connote_id);
        $this->assertEquals($data['customer_origin_id'], $package->customer_origin_id);
        $this->assertEquals($data['customer_destination_id'], $package->customer_destination_id);
        $this->assertEquals($data['custom_field_id'], $package->custom_field_id);
        $this->assertEquals($data['current_location_id'], $package->current_location_id);
        $this->assertEquals($data['customer_name'], $package->customer_name);
        $this->assertEquals($data['customer_code'], $package->customer_code);
        $this->assertEquals($data['transaction_amount'], $package->transaction_amount);
        $this->assertEquals($data['transaction_discount'], $package->transaction_discount);
        $this->assertEquals($data['transaction_additional_field'], $package->transaction_additional_field);
        $this->assertEquals($data['transaction_payment_type'], $package->transaction_payment_type);
        $this->assertEquals($data['transaction_state'], $package->transaction_state);
        $this->assertEquals($data['transaction_code'], $package->transaction_code);
        $this->assertEquals($data['transaction_order'], $package->transaction_order);
        $this->assertEquals($data['transaction_payment_type_name'], $package->transaction_payment_type_name);
        $this->assertEquals($data['transaction_cash_amount'], $package->transaction_cash_amount);
        $this->assertEquals($data['transaction_cash_change'], $package->transaction_cash_change);
    }

    public function test_create_koli_and_koli_custom_field(): void
    {
        $data = [
            // column
            'awb_sicepat' => null,
            'price' => null,
        ];

        $koli_custom_field = KoliCustomField::create($data);

        $this->assertInstanceOf(KoliCustomField::class, $koli_custom_field);
        $this->assertEquals($data['awb_sicepat'], $koli_custom_field->awb_sicepat);
        $this->assertEquals($data['price'], $koli_custom_field->price);

        $data = [
            // foreign
            'formula_id' => null,
            'package_id' => Package::first()->id,
            'connote_id' => Connote::first()->id,
            'koli_custom_field_id' => $koli_custom_field->id,
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

        $koli = Koli::create($data);

        $this->assertInstanceOf(Koli::class, $koli);
        $this->assertEquals($data['formula_id'], $koli->formula_id);
        $this->assertEquals($data['package_id'], $koli->package_id);
        $this->assertEquals($data['connote_id'], $koli->connote_id);
        $this->assertEquals($data['koli_custom_field_id'], $koli->koli_custom_field_id);
        $this->assertEquals($data['length'], $koli->length);
        $this->assertEquals($data['awb_url'], $koli->awb_url);
        $this->assertEquals($data['chargeable_weight'], $koli->chargeable_weight);
        $this->assertEquals($data['width'], $koli->width);
        $this->assertEquals($data['surcharge'], $koli->surcharge);
        $this->assertEquals($data['height'], $koli->height);
        $this->assertEquals($data['description'], $koli->description);
        $this->assertEquals($data['volume'], $koli->volume);
        $this->assertEquals($data['weight'], $koli->weight);
        $this->assertEquals($data['code'], $koli->code);
    }
}
