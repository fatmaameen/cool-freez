<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    public function up(): void
    {
        DB::table('building_types')->insert([
            'id' => '1',
            'name' => 'villa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('building_types')->insert([
            'id' => '2',
            'name' => 'office',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('building_types')->insert([
            'id' => '3',
            'name' => 'home',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('building_types')->insert([
            'id' => '4',
            'name' => 'residential building',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
