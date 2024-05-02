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
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('address');
            $table->string('street_address');
            $table->string('lat');
            $table->string('long');
            $table->string('phone_number');
            $table->string('device_type');
            $table->text('type_of_malfunction');
            $table->enum('admin_status',  ['waiting','confirmed','cancelled'])->default('waiting');
            $table->boolean('assigned')->default(false);
            $table->enum('company_status',['pending','confirmed','cancelled'])->default('pending');
            $table->unsignedBigInteger('technical_id')->default(0);
            // $table->foreign('technical_id')->references('id')->on('technicians')->onDelete('cascade');
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
