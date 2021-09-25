<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Categories;

class SeedTableCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::insert([
            [
                'name' => 'Bencana'
            ],
            [
                'name' => 'Kecelakaan'
            ],
            [
                'name' => 'Medis'
            ],
            [
                'name' => 'Pembangunan Infrastruktur'
            ],
        ]);
    }
}
