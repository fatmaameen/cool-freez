<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            'name'      => 'admin',
            'role_id'      => '1',
            'password'  => bcrypt('123456789'),
            'email'     => 'admin@admin.com',
            'phone_number'     => '0123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

};
