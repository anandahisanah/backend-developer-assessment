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
        Schema::create('packages', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign
            $table->integer('transaction_id');
            $table->string('location_id');
            $table->integer('organization_id');
            // foreign to -> customer_attributes
            $table->unsignedBigInteger('customer_attribute_id');
            $table->foreign('customer_attribute_id')->references('id')->on('customer_attributes');
            // foreign to -> connotes
            $table->unsignedBigInteger('connote_id');
            $table->foreign('connote_id')->references('id')->on('connotes');
            // foreign to -> current_locations
            $table->unsignedBigInteger('current_location_id');
            $table->foreign('current_location_id')->references('id')->on('current_locations');
            // column
            $table->string('customer_name');
            $table->string('customer_code');
            $table->string('transaction_amount');
            $table->string('transaction_discount');
            $table->string('transaction_additional_field');
            $table->string('transaction_payment_type');
            $table->string('transaction_state');
            $table->string('transaction_code');
            $table->integer('transaction_order');
            $table->string('transaction_payment_type_name');
            $table->integer('transaction_cash_amount');
            $table->integer('transaction_cash_change');
            // timestamp
            $table->timestampsTz();
        });

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
            $table->integer('state_id');
            $table->string('transaction_id');
            $table->integer('organization_id');
            $table->string('location_id');
            // column
            $table->integer('connote_number');
            $table->string('connote_service');
            $table->integer('connote_service_price');
            $table->integer('connote_amount');
            $table->string('connote_code');
            $table->string('connote_booking_code')->nullable();
            $table->integer('connote_order');
            $table->string('connote_state');
            $table->string('zone_code_from');
            $table->string('zone_code_to');
            $table->string('surcharge_amount')->nullable();
            $table->integer('actual_weight');
            $table->integer('volume_weight');
            $table->integer('chargeable_weight');
            $table->string('connote_total_package')->default('0');
            $table->string('connote_surcharge_amount')->default('0');
            $table->string('connote_sla_day')->default('0');
            $table->string('location_name');
            $table->string('location_type');
            $table->string('source_tariff_db');
            $table->string('id_source_tariff');
            $table->string('pod')->nullable();
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('customers', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign
            $table->integer('organization_id');
            $table->string('location_id');
            // column
            $table->string('type'); // origin, destination
            $table->string('name');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address_detail')->nullable();
            $table->string('zip_code');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('kolies', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign
            $table->integer('formula_id')->nullable();
            // foreign to -> packages
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            // foreign to -> connotes
            $table->unsignedBigInteger('connote_id');
            $table->foreign('connote_id')->references('id')->on('connotes');
            // column
            $table->integer('length');
            $table->string('awb_url');
            $table->integer('chargeable_weight');
            $table->integer('width');
            $table->json('surcharge')->default();
            $table->integer('height');
            $table->string('description');
            $table->integer('volume');
            $table->integer('weight');
            $table->string('code');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('koli_custom_fields', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign to -> kolies
            $table->unsignedBigInteger('koli_id');
            $table->foreign('koli_id')->references('id')->on('kolies');
            // column
            $table->string('awb_sicepat');
            $table->string('price');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('custom_fields', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign to -> packages
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            // column
            $table->string('note');
            // timestamp
            $table->timestampsTz();
        });

        Schema::create('current_locations', function (Blueprint $table) {
            // primary
            $table->id()->unsigned();
            $table->uuid();
            // foreign to -> packages
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            // column
            $table->string('name');
            $table->string('code');
            $table->string('type');
            // timestamp
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_locations');
        Schema::dropIfExists('custom_fields');
        Schema::dropIfExists('koli_custom_fields');
        Schema::dropIfExists('kolies');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('connotes');
        Schema::dropIfExists('customer_attributes');
        Schema::dropIfExists('packages');
    }
};
