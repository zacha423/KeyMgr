<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
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
    // $this->call(CountrySeeder::class);
    // $this->call(StateSeeder::class);
    // $this->call(CitySeeder::class); 
    $this->call(AddressSeeder::class);
    \App\Models\User::factory(10)->create();
  }
}
