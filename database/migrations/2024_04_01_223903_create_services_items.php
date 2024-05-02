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
        DB::table('services')->insert([
            'id' => '1',
            'service_name' => 'Maintenance',
            'cover' => 'Maintenance.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('services')->insert([
            'id' => '2',
            'service_name' => 'Pricing',
            'cover' => 'Pricing.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('services')->insert([
            'id' => '3',
            'service_name' => 'Review',
            'cover' => 'Review.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('services')->insert([
            'id' => '4',
            'service_name' => 'Load calculation',
            'cover' => 'Load.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

};
