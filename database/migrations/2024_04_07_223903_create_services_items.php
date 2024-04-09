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
            'id' => '11',
            'service_name' => 'Pricing',
            'cover' => 'Pricing.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('services')->insert([
            'id' => '111',
            'service_name' => 'Review',
            'cover' => 'Review.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('services')->insert([
            'id' => '1111',
            'service_name' => 'Load calculation',
            'cover' => 'Load.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

};
