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
    $this->call(AddressSeeder::class);
    $this->call(CampusSeeder::class);
    $this->call(BuildingSeeder::class);
    $this->call(RoomSeeder::class);
    \App\Models\User::factory(10)->create();
  }
}
