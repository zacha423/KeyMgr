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

    // foreach ($roles as $role) {
    //   UserRole::create($role);
    // }

    UserRole::factory()->createMany($roles);


    // $role = UserRole::create($roles[0]);
    // $role->save();
    // UserRole::createMany ($roles);
    // $roles->save();
    // UserRole::insert($roles);
    // DB::table('user_roles')->insert($roles);
  }
}
