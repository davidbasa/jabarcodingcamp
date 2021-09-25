<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Payment;

class SeedTablePayment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::insert([
            [
                'name' => 'Bank BCA',
                'logo' => 'https://assets.kitabisa.cc/images/banks/bca.png',
                'account' => "3794623439 A/N Jabar Bangkit Bersama"
            ],
            [
                'name' => 'Bank BNI',
                'logo' => 'https://assets.kitabisa.cc/images/banks/bni.png',
                'account' => "45246125 A/N Jabar Bangkit Bersama"
            ],
            [
                'name' => 'Bank BRI',
                'logo' => 'https://assets.kitabisa.cc/images/banks/bri.png',
                'account' => "623623423 A/N Jabar Bangkit Bersama"
            ],
        ]);
    }
}
