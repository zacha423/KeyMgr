<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserGroup;
use App\Models\UserRole;
use App\Models\User;

class UserAccountSeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    foreach (User::factory(100)->create() as $user) {
      $user->groups()->syncWithoutDetaching (UserGroup::inRandomOrder()->first());
      $user->roles()->syncWithoutDetaching (UserRole::inRandomOrder()->first());
    }
  }
}
