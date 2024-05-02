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
        Schema::create('load_calculations', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('model_id')->references('id')->on('data_sheets')->onDelete('cascade');;
            // $table->foreign('model_id')->references('id')->on('data_sheets')->onDelete('cascade');
            $table->enum('admin_status',  ['waiting','confirmed','cancelled'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('load_calculations');
    }
};
