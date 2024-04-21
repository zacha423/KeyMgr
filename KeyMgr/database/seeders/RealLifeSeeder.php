<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\Wrappers\AddressWrapper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Building;
use App\Models\Campus;
use App\Models\Door;
use App\Models\Lock;
use App\Models\Key;
use App\Models\Room;
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
      'username' => 'casdirector',
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
    $CSProf->roles()->saveMany([
      UserRole::where(['name' => config('constants.roles.holder')])->first(),
      UserRole::where(['name' => config('constants.roles.requestor')])->first(),
    ]);

    $MathProf = User::create([
      'firstName' => 'Math',
      'lastName' => 'Prof',
      'username' => 'mathprof',
      'email' => 'mathprof' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $MathProf->groups()->save(UserGroup::where(['name' => 'Mathematics'])->first());
    $MathProf->roles()->saveMany([
      UserRole::where(['name' => config('constants.roles.holder')])->first(),
      UserRole::where(['name' => config('constants.roles.requestor')])->first(),
    ]);

    $DSProf = User::create([
      'firstName' => 'Data Sci',
      'lastName' => 'Prof',
      'username' => 'dsprof',
      'email' => 'dsprof' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $DSProf->groups()->save(UserGroup::where(['name' => 'Data Science'])->first());
    $DSProf->roles()->saveMany([
      UserRole::where(['name' => config('constants.roles.holder')])->first(),
      UserRole::where(['name' => config('constants.roles.requestor')])->first(),
    ]);

    $BIProf = User::create([
      'firstName' => 'Bio-Info',
      'lastName' => 'Prof',
      'username' => 'biprof',
      'email' => 'biprof' . $emailTLD,
      'password' => $testAcctPassword,
    ]);
    $BIProf->groups()->save(UserGroup::where(['name' => 'Bio-Informatics'])->first());
    $BIProf->roles()->saveMany([
      UserRole::where(['name' => config('constants.roles.holder')])->first(),
      UserRole::where(['name' => config('constants.roles.requestor')])->first(),
    ]);

    $PacUFG = AddressWrapper::build([
      'country' => 'United States of America',
      'state' => 'Oregon',
      'city' => 'Forest Grove',
      'postalCode' => 97116,
      'streetAddress' => '2043 College Way',
    ]);

    ($FGUGCampus = new Campus([
      'name' => 'Forest Grove',
      'address_id' => $PacUFG->id
    ]))->save();

    $PacUHills = AddressWrapper::build([
      'country' => 'United States of America',
      'state' => 'Oregon',
      'city' => 'Hillsboro',
      'postalCode' => 97116,
      'streetAddress' => '222 SE 8th Ave',
    ]);
    ($HPCampus = new Campus([
      'name' => 'College of Health Professions',
      'address_id' => $PacUHills->id,
    ]))->save();

    $CoCCityHall = AddressWrapper::build([
      'country' => 'United States of America',
      'state' => 'Oregon',
      'city' => 'Cornelius',
      'postalCode' => 97113,
      'streetAddress' => '1355 N Barlow St',
    ]);
    ($CoCCityCenter = new Campus([
      'name' => 'Cornelius City Center',
      'address_id' => $CoCCityHall->id,
    ]))->save();

    $CoCKodiak = AddressWrapper::build([
      'country' => 'United States of America',
      'state' => 'Oregon',
      'city' => 'Cornelius',
      'postalCode' => 97113,
      'streetAddress' => '1300 S Kodiak Circle',
    ]);
    ($CocKodiakCampus = new Campus([
      'name' => 'Cornelius Public Works',
      'address_id' => $CoCKodiak->id,
    ]))->save();

    ($CoCCityHallBuilding = new Building([
      'name' => 'Cornelius City Hall',
      'campus_id' => $CoCCityCenter->id,
      'address_id' => $CoCCityHall->id,
    ]))->save();


    ($CoCLibrary = new Building([
      'name' => 'Cornelius Public Library',
      'campus_id' => $CoCCityCenter->id,
      'address_id' => AddressWrapper::build([
        'country' => 'United States of America',
        'state' => 'Oregon',
        'city' => 'Cornelius',
        'postalCode' => 97113,
        'streetAddress' => '1370 N Adair St'
      ])->id,
    ]))->save();
    ($CoCPublicSafety = new Building([
      'name' => 'Public Safety',
      'campus_id' => $CoCCityCenter->id,
      'address_id' => AddressWrapper::build([
        'country' => 'United States of America',
        'state' => 'Oregon',
        'city' => 'Cornelius',
        'postalCode' => 97113,
        'streetAddress' => '1311 N Barlow St'
      ])->id,
    ]))->save();



    // Add some buildings
    ($MarshHall = new Building([
      'name' => 'Marsh Hall',
      'campus_id' => $FGUGCampus->id,
      'address_id' => $PacUFG->id,
    ]))->save();
    ($PriceHall = new Building([
      'name' => 'Price Hall',
      'campus_id' => $FGUGCampus->id,
      'address_id' => AddressWrapper::build([
        'country' => 'United States of America',
        'state' => 'Oregon',
        'city' => 'Cornelius',
        'postalCode' => 97113,
        'streetAddress' => '2150 Cedar Street'
      ])->id,
    ]))->save();
    ($Strain = new Building([
      'name' => 'Strain Science Center',
      'campus_id' => $FGUGCampus->id,
      'address_id' => AddressWrapper::build([
        'country' => 'United States of America',
        'state' => 'Oregon',
        'city' => 'Cornelius',
        'postalCode' => 97113,
        'streetAddress' => '2172 Cedar Street'
      ])->id,
    ]))->save();
    ($AuCoin = new Building([
      'name' => 'AuCoin Hall',
      'campus_id' => $FGUGCampus->id,
      'address_id' => AddressWrapper::build([
        'country' => 'United States of America',
        'state' => 'Oregon',
        'city' => 'Cornelius',
        'postalCode' => 97113,
        'streetAddress' => '2125 College Way'
      ])->id,
    ]))->save();
    ($Creighton = new Building([
      'name' => 'Creighton Hall',
      'campus_id' => $HPCampus->id,
      'address_id' => AddressWrapper::build([
        'country' => 'United States of America',
        'state' => 'Oregon',
        'city' => 'Cornelius',
        'postalCode' => 97113,
        'streetAddress' => '222 SE 8th Ave'
      ])->id,
    ]))->save();
    ($HPC2 = new Building([
      'name' => 'Health Professions Campus 2',
      'campus_id' => $HPCampus->id,
      'address_id' => AddressWrapper::build([
        'country' => 'United States of America',
        'state' => 'Oregon',
        'city' => 'Cornelius',
        'postalCode' => 97113,
        'streetAddress' => '190 SE 8th Ave'
      ])->id,
    ]))->save();

    $CoCCityHallBuilding->rooms()->saveMany([
      new Room(['number' => 'Council Chambers']),
      new Room(['number' => 'Lobby']),
    ]);

    $CoCPublicSafety->rooms()->saveMany([
      new Room(['number' => 'Fire Bay']),
      new Room(['number' => '2A']),
      new Room(['number' => 'Break Room']),
    ]);

    $CoCLibrary->rooms()->saveMany([
      new Room(['number' => 'Westerling Board Room']),
      new Room(['number' => "Walter's Gallery"]),
      new Room(['number' => "Walter's Community Room"]),
      new Room(['number' => 'Study Room 1']),
      new Room(['number' => 'Study Room 2']),
      new Room(['number' => 'Study Room 3']),
      new Room(['number' => 'Makerspace']),
    ]);

    // Add rooms to the buildings
    $MarshHall->rooms()->saveMany([
      new Room([
        'number' => 'LL6',
        'description' => 'TIC Helpdesk'
      ]),
      new Room([
        'number' => '216',
        'description' => 'Taylor Auditorium',
      ]),
    ]);

    $PriceHall->rooms()->saveMany([
      new Room([
        'number' => 204,
      ]),
      new Room([
        'number' => 218,
      ]),
    ]);

    $Strain->rooms()->saveMany([
      new Room([
        'number' => 222,
        'description' => 'CS Lab',
      ]),
      new Room([
        'number' => 201,
      ]),
      new Room([
        'number' => 202,
      ]),
      new Room([
        'number' => '203C',
      ]),
      new Room([
        'number' => 221,
      ]),
    ]);

    $AuCoin->rooms()->saveMany([
      new Room([
        'number' => 203,
      ]),
      new Room([
        'number' => 204,
      ]),
      new Room([
        'number' => 205,
      ]),
    ]);

    // Attach a blank door to each of the created rooms
    foreach ([$MarshHall, $PriceHall, $Strain, $AuCoin] as $building) {
      foreach ($building->rooms()->get() as $room) {
        $door = new Door();
        $room->doors()->save($door);
        $lock = Lock::factory()->Create();
        $lock->keys()->save(Key::factory()->create());
        $door->locks()->save($lock);
      }
    }
  }
}
