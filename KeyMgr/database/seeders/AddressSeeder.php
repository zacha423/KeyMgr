<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Provider\en_US\Address;
class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // need array with iso3, country nme, state name, state abbrev, city, address, postalcode
        $data = fake()->address();
        echo $data;
    }
}
