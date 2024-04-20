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
        Schema::create('pricing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pricing_id')->foreign('pricing_id')->references('id')->on('pricings')->onDelete('cascade');
            $table->string('building_type');
            $table->string('floor');
            $table->string('brand');
            $table->string('air_conditioning_type');
            $table->string('drawing_of_building');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_details');
    }
};
