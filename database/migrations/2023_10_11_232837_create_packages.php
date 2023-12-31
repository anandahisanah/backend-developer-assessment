<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_attributes', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // column
            $table->string('sales_name');
            $table->string('top');
            $table->string('type');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('connotes', function (Blueprint $table) {
            // primary
            $table->id();
            $table->uuid();
            // foreign
            $table->integer('connote_state_id')->default(0);
            $table->uuid('transaction_id');
            $table->integer('organization_id')->default(0);
            $table->string('location_id');
            // column
            $table->integer('connote_number')->default(0);
            $table->string('connote_service');
            $table->integer('connote_service_price')->default(0);
            $table->integer('connote_amount')->default(0);
            $table->string('connote_code');
            $table->string('connote_booking_code')->nullable();
            $table->integer('connote_order')->default(0);
            $table->string('connote_state');
            $table->string('zone_code_from');
            $table->string('zone_code_to');
            $table->string('surcharge_amount')->nullable();
            $table->integer('actual_weight')->default(0);
            $table->integer('volume_weight')->default(0);
            $table->integer('chargeable_weight')->default(0);
            $table->string('connote_total_package')->default('0');
            $table->string('connote_surcharge_amount')->default('0');
            $table->string('connote_sla_day')->default('0');
            $table->string('location_name');
            $table->string('location_type');
            $table->string('source_tariff_db');
            $table->string('id_source_tariff');
            $table->string('pod')->nullable();
            $table->json('history');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('custom_fields', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // column
            $table->string('note');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('current_locations', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // column
            $table->string('name');
            $table->string('code');
            $table->string('type');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('packages', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign
            $table->uuid('transaction_id');
            $table->string('location_id');
            $table->integer('organization_id')->default(0);
            $table->integer('customer_origin_id')->default(0);
            $table->integer('customer_destination_id')->default(0);
            // foreign to -> customer_attributes
            $table->unsignedBigInteger('customer_attribute_id');
            $table->foreign('customer_attribute_id')->references('id')->on('customer_attributes');
            // foreign to -> connotes
            $table->unsignedBigInteger('connote_id');
            $table->foreign('connote_id')->references('id')->on('connotes');
            // foreign to -> custom_fields
            $table->unsignedBigInteger('custom_field_id');
            $table->foreign('custom_field_id')->references('id')->on('custom_fields');
            // foreign to -> current_locations
            $table->unsignedBigInteger('current_location_id');
            $table->foreign('current_location_id')->references('id')->on('current_locations');
            // column
            $table->string('customer_name');
            $table->string('customer_code');
            $table->string('transaction_amount');
            $table->string('transaction_discount');
            $table->string('transaction_additional_field')->nullable();
            $table->string('transaction_payment_type');
            $table->string('transaction_state');
            $table->string('transaction_code');
            $table->integer('transaction_order')->default(0);
            $table->string('transaction_payment_type_name');
            $table->integer('transaction_cash_amount')->default(0);
            $table->integer('transaction_cash_change')->default(0);
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('customers', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign
            $table->integer('organization_id')->default(0);
            $table->string('location_id');
            // column
            $table->string('type'); // origin, destination
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->string('customer_address_detail')->nullable();
            $table->string('customer_zip_code');
            $table->string('zone_code');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('koli_custom_fields', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // column
            $table->string('awb_sicepat')->nullable();
            $table->string('price')->nullable();
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('kolies', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign
            $table->string('formula_id')->nullable();
            // foreign to -> packages
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            // foreign to -> connotes
            $table->unsignedBigInteger('connote_id');
            $table->foreign('connote_id')->references('id')->on('connotes');
            // foreign to -> koli_custom_fields
            $table->unsignedBigInteger('koli_custom_field_id');
            $table->foreign('koli_custom_field_id')->references('id')->on('koli_custom_fields');
            // column
            $table->integer('length')->default(0);
            $table->string('awb_url');
            $table->integer('chargeable_weight')->default(0);
            $table->integer('width')->default(0);
            $table->json('surcharge');
            $table->integer('height')->default(0);
            $table->string('description');
            $table->integer('volume')->default(0);
            $table->integer('weight')->default(0);
            $table->string('code');
            // timestamp
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolies');
        Schema::dropIfExists('koli_custom_fields');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('current_locations');
        Schema::dropIfExists('custom_fields');
        Schema::dropIfExists('connotes');
        Schema::dropIfExists('customer_attributes');
    }
};
