<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB, Hash;

class SeedTableUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
}
