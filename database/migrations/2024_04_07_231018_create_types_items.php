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
        DB::table('types')->insert([
            'id' => '1',
            'type' => '{"en":"split","ar":"سبليت"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('types')->insert([
            'id' => '2',
            'type' => '{"en":"packaged","ar":"باكج"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

};
