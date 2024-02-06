<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
class CountrySeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //

    $countries = [
      ['ISOCode3' => 'USA', 'name' => 'United States of America'],
    ];

    Country::factory()->createMany($countries);

    Country::factory()->createMany(3);
    
  }
}
