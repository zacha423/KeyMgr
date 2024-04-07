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

class RealLifeSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    UserGroup::factory()->createMany([
      ['name' => 'University Information Services'],
      ['name' => 'Facilities'],
      ['name' => 'Mail Services'],
      ['name' => 'Undergraduate Students'],
      ['name' => 'Graduate Students'],
      ['name' => 'Staff'],
      ['name' => 'Faculty'],
    ]);

    $CAS = UserGroup::create(['name' => 'College or Arts and Sciences']);
    $SNS = new UserGroup(['name' => 'School of Natural Sciences']);
    $SNS->parent_id_fk = $CAS->id;
    $SNS->save();

    $SNS->children()->saveMany(UserGroup::factory()->createMany([
      ['name' => 'Mathematics'],
      ['name' => 'Computer Science'],
      ['name' => 'Data Science'],
      ['name' => 'Bio-Informatics'],
    ]));

    $testAcctPassword = "Abcd123!";
    $UISAdmin = User::create(
      [
        'firstName' => 'UIS',
        'lastName' => 'IT Admin',
        'username' => 'itadmin',
        'email' => 'itadmin@keymgr.com',
        'password' => $testAcctPassword
      ]
    );
    $UISAdmin->groups()->save(UserGroup::where(['name' => 'University Information Services'])->first());
    $UISAdmin->roles()->save(UserRole::where(['name' => config('constants.roles.admin')])->first());

    $FacilitiesLocksmith = User::create([

      'firstName' => 'Facilities',
      'lastName' => 'Locksmith',
      'username' => 'facilitiesls',
      'email' => 'locksmith2@keymgr.com',
      'password' => $testAcctPassword,
    ]);

    $FacilitiesLocksmith->groups()->save(UserGroup::where(['name' => 'Facilities'])->first());
    $FacilitiesLocksmith->roles()->save(UserRole::where(['name' => config('constants.roles.locksmith')])->first());

    $FacilitiesKeyIssuer = User::create([
      'firstName' => 'Facilities',
      'lastName' => 'Key Issuer',
      'username' => 'facilitieski',
      'email' => 'keyissuer2@keymgr.com',
      'password' => $testAcctPassword,
    ]);
  }
}
