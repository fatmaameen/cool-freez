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
        DB::table('brands')->insert([
            'id' => '1',
            'brand' => '{"en":"carrier","ar":"كارير"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('brands')->insert([
            'id' => '2',
            'brand' => '{"en":"coolex","ar":"كوليكس"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('brands')->insert([
            'id' => '3',
            'brand' => '{"en":"smk","ar":"إس لإم كى"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
