<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserRole;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(ManufacturerSeeder::class);
    $this->call(LockModelSeeder::class);
    $this->call(KeywaySeeder::class);

    $this->call(RealLifeSeeder::class);
    
    $this->call(UserGroupSeeder::class);
    $this->call(AddressSeeder::class);
    $this->call(CampusSeeder::class);
    $this->call(BuildingSeeder::class);
    $this->call(RoomSeeder::class);
    $this->call(DoorSeeder::class);
    $this->call(TestAccountsSeeder::class);
    $this->call(MessageTemplateSeeder::class);
    $this->call(StorageSeeder::class);
    $this->call(KeySeeder::class);
    $this->call(KeyAuthSeeder::class);
    $this->call(LockSeeder::class);
    $this->call(UserAccountSeeder::class);
    
  }
}
