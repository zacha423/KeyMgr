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
    $testAcctPassword = "Abcd123!";
    $emailTLD = '@example.com';

    UserGroup::factory()->createMany([
      ['name' => 'University Information Services'],
      ['name' => 'Facilities'],
      ['name' => 'Mail Services'],
      ['name' => 'Undergraduate Students'],
      ['name' => 'Graduate Students'],
      ['name' => 'Staff'],
      ['name' => 'Faculty'],
    ]);

    $CAS = UserGroup::create(['name' => 'College of Arts and Sciences']);
    $SNS = new UserGroup(['name' => 'School of Natural Sciences']);
    $SNS->parent_id_fk = $CAS->id;
    $SNS->save();

    $SNS->children()->saveMany(UserGroup::factory()->createMany([
      ['name' => 'Mathematics'],
      ['name' => 'Computer Science'],
      ['name' => 'Data Science'],
      ['name' => 'Bio-Informatics'],
    ]));

    
    $ITAdmin = User::create(
      [
        'firstName' => 'UIS',
        'lastName' => 'IT Admin',
        'username' => 'itadmin',
        'email' => 'itadmin@keymgr.com',
        'password' => $testAcctPassword
      ]
    );
    $ITAdmin->groups()->save(UserGroup::where(['name' => 'University Information Services'])->first());
    $ITAdmin->roles()->save(UserRole::where(['name' => config('constants.roles.admin')])->first());

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
    $FacilitiesKeyIssuer->groups()->save(UserGroup::where(['name' => 'Facilities'])->first());
    $FacilitiesKeyIssuer->roles()->save(UserRole::where(['name' => config('constants.roles.issuer')])->first());

    $MailClerk = User::create([
      'firstName' => 'Mail', 
      'lastName' => 'Clerk', 
      'username' => 'clerk', 
      'email' => 'mailclerk' . $emailTLD, 
      'password' => $testAcctPassword,
    ]);
    $MailClerk->groups()->save(UserGroup::where(['name' => 'Mail Services'])->first());
    $MailClerk->roles()->saveMany([
      UserRole::where(['name' => config('constants.roles.issuer')])->first(), 
      UserRole::where(['name' => config('constants.roles.locksmith')])->first(),
    ]);

    $CASDirector = User::create([
      'firstName' => 'CAS',
      'lastName' => 'Director',
      'username'=>'casdirector',
      'email' => 'cas' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $CASDirector->groups()->save($CAS);
    $CASDirector->roles()->save(UserRole::where(['name' => config('constants.roles.authority')])->first());

    $NatSciAdm = User::create([
      'firstName' => 'Natural Sciences',
      'lastName' => 'Admin',
      'username' => 'natsciadm',
      'email' => 'natsci' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $NatSciAdm->groups()->save($SNS);
    $NatSciAdm->roles()->save(UserRole::where(['name' => config('constants.roles.authority')])->first());

    $CSProf = User::create([
      'firstName' => 'Comp. Sci',
      'lastName' => 'Prof',
      'username' => 'csprof',
      'email' => 'csprof' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $CSProf->groups()->save(UserGroup::where(['name' => 'Computer Science'])->first());
    $CSProf->roles()->saveMany([UserRole::where(['name' => config('constants.roles.holder')])->first(),UserRole::where(['name' => config('constants.roles.requestor')])->first()]);

    $MathProf = User::create([
      'firstName' => 'Math',
      'lastName' => 'Prof',
      'username' => 'mathprof',
      'email' => 'mathprof' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $MathProf->groups()->save(UserGroup::where(['name' => 'Mathematics'])->first());
    $MathProf->roles()->saveMany([UserRole::where(['name' => config('constants.roles.holder')])->first(),UserRole::where(['name' => config('constants.roles.requestor')])->first()]);

    $DSProf = User::create([
      'firstName' => 'Data Sci',
      'lastName' => 'Prof',
      'username' => 'dsprof',
      'email' => 'dsprof' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $DSProf->groups()->save(UserGroup::where(['name' => 'Data Science'])->first());
    $DSProf->roles()->saveMany([UserRole::where(['name' => config('constants.roles.holder')])->first(),UserRole::where(['name' => config('constants.roles.requestor')])->first()]);

    $BIProf = User::create([
      'firstName' => 'Bio-Info',
      'lastName' => 'Prof',
      'username' => 'biprof',
      'email' => 'biprof' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $BIProf->groups()->save(UserGroup::where(['name' => 'Bio-Informatics'])->first());
    $BIProf->roles()->saveMany([UserRole::where(['name' => config('constants.roles.holder')])->first(),UserRole::where(['name' => config('constants.roles.requestor')])->first()]);


    
    
  }
}
