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



        DB::table('floors')->insert([
            'id' => '1',
            'floor_number' => 'basement',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('floors')->insert([
            'id' => '2',
            'floor_number' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('floors')->insert([
            'id' => '3',
            'floor_number' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('floors')->insert([
            'id' => '4',
            'floor_number' => '3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        
        DB::table('usings')->insert([
            'id' => '1',
            'using_name' => 'diwaniyah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('usings')->insert([
            'id' => '2',
            'using_name' => 'state',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
