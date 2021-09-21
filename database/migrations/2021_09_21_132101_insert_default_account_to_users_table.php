<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InsertDefaultAccountToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Super Admin',
                'email' => 'admin@jbb.id',
                'password' => Hash::make('adminjbb'),
                'email_verified_at' => NULL,
                'role_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'name' => 'Contoh Donatur',
                'email' => 'donatur@jbb.id',
                'password' => Hash::make('donaturjbb'),
                'email_verified_at' => NULL,
                'role_id' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
