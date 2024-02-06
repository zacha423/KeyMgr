<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(UserRoleSeeder::class);
    $this->call(UserGroupSeeder::class);
    $this->call(CountrySeeder::class);
    \App\Models\User::factory(10)->create();
  }
}
