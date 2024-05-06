<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    public function up(): void
    {
        DB::table('building_types')->insert([
            'id' => '1',
            'name' => '{"en":"villa","ar":"ڤيلا"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('building_types')->insert([
            'id' => '2',
            'name' => '{"en":"office","ar":"مكتب"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('building_types')->insert([
            'id' => '3',
            'name' => '{"en":"home","ar":"منزل"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('building_types')->insert([
            'id' => '4',
            'name' => '{"en":"residential building","ar":"عمارة سكنية"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
