<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\KeyAuthorization;
use App\Models\KeyAuthStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Key;
use App\Models\User;
use App\Models\KeyStatus;

class DemoUserSeeder extends Seeder
{
  /**
   * Add a key to a given room.
   */
  protected function addKeyToRoom(Room $room): Key
  {
    $key = Key::factory()->unassigned()->create();

    $room->doors()->first()->locks()->first()->keys()->save($key);
    return $key;
  }
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $demoUser = User::create([
      'firstName' => 'Demo',
      'lastName' => 'User',
      'username' => 'demo',
      'email' => 'demo@keymgr.com',
      'password' => 'Abcd123!',
    ]);

    $boardRoomKey = $this->addKeyToRoom($boardRoom = Room::where([
      'number' => 'Westerling Board Room'
    ])->first());
    $galleryRoomKey = $this->addKeyToRoom($galleryRoom = Room::where([
      'number' => "Walter's Gallery"
    ])->first());
    $communityRoomKey = $this->addKeyToRoom($communityRoom = Room::where([
      'number' => "Walter's Community Room"
    ])->first());

    $rooms = [$boardRoom, $galleryRoom, $communityRoom];
    $keys = [$boardRoomKey, $galleryRoomKey, $communityRoomKey];
    $requestor = User::whereHas('roles', function ($query) { 
      $query->where(['name' => config('constants.roles.requestor')]); 
    })->first();
    
    $auth = new KeyAuthorization();
    $auth->key_holder_user_id = $demoUser->id;
    $auth->requestor_user_id = $requestor->id;
    $auth->key_auth_status_id = KeyAuthStatus::where(['name' => 'New'])->first()->id;
    $auth->save();   
    
    foreach ($keys as $k) {
      $k->key_status_id = KeyStatus::where(['name' => 'Assigned'])->first()->id;
      $k->save();
      $auth->issuedKeys()->attach($k, ['due_date' => fake()->dateTimeBetween('+1 week', '+3 month')->format('Y-m-d')]);
    }

    foreach ($rooms as $r) {
      $auth->rooms()->attach($r);
    }
  }
}
