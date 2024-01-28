<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $roles = array (
      ['name' => 'Key Holder'],
      ['name' => 'Key Requestor'],
      ['name' => 'Key Authority'],
      ['name' => 'Key Issuer'],
      ['name' => 'Locksmith'],
      ['name' => 'Admin'],
    );

    UserRole::factory()->createMany($roles);
  }
}
