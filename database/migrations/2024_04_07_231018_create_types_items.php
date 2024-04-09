<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
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
            'type' => 'split',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('types')->insert([
            'id' => '2',
            'type' => 'packaged',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

};
