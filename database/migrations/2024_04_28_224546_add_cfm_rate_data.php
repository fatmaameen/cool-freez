<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('cfm_rates')->insert([
            'id' => '1',
            'poor_from' => '0',
            'poor_to' => '19',
            'good_from' => '20',
            'good_to' => '24',
            'excellent_from' => '20',
            'excellent_to' => '50',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
