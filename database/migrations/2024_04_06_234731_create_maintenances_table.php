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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->unsignedBigInteger('client_id')->foreign()->references('id')->on('clients');
            $table->string('address');
            $table->string('street_address');
            $table->string('phone_number');
            $table->string('device_type');
            $table->text('type_of_malfunction');
            $table->enum('admin_status',  ['waiting','confirmed','cancelled'])->default('waiting');
            $table->boolean('assigned')->default(false);
            $table->enum('company_status',['pending','confirmed','cancelled'])->default('pending');
            $table->unsignedBigInteger('technical')->default(0);
            $table->date('expected_service_date')->default('2024-01-01');
            $table->enum('technical_status',['pending','confirmed','out to service','completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
