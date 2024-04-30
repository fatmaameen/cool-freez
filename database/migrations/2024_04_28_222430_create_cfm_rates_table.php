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
        Schema::create('cfm_rates', function (Blueprint $table) {
            $table->id();
            $table->decimal('poor_from', 5, 2);
            $table->decimal('poor_to', 5, 2);
            $table->decimal('good_from', 5, 2);
            $table->decimal('good_to', 5, 2);
            $table->decimal('excellent_from', 5, 2);
            $table->decimal('excellent_to', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cfm_rates');
    }
};
