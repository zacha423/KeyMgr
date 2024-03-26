<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserRole;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(UserGroupSeeder::class);
    $this->call(AddressSeeder::class);
    $this->call(CampusSeeder::class);
    $this->call(BuildingSeeder::class);
    $this->call(RoomSeeder::class);
    $this->call(DoorSeeder::class);
    $this->call(TestAccountsSeeder::class);


    User::factory(50)->create();

    foreach (User::all() as $user) { 
      $user->groups()->syncWithoutDetaching(UserGroup::all()->random(1));
      $user->roles()->syncWithoutDetaching(UserRole::all()->random(1)); 
    }
    $this->call(MessageTemplateSeeder::class);
    \App\Models\User::factory(50)->create();
    $this->call(KeywaySeeder::class);
    $this->call(StorageSeeder::class);
    $this->call(KeySeeder::class);
    $this->call(KeyAuthSeeder::class);
  }
}
