<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * This is insurance so we can make the following assumptions in our sample data:
 * - Each room has a door.
 * - Each door has a lock.
 * - Each lock has at least 2 keys that are considered available.
 */
namespace Database\Seeders;

use App\Models\KeyStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Door;
use App\Models\Key;
use App\Models\Lock;

class ForceAvailableKeysSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    foreach (Room::all() as $room) {
      if ($room->doors()->count() == 0) {
        $room->doors()->save(new Door());
      }

      $door = $room->doors()->first();

      if ($door->locks()->count() == 0) {
        $door->locks()->save(Lock::factory()->create());
      }

      $door->locks()->first()->keys()->saveMany(Key::factory()->unassigned()->createMany(3));
    }
  }
}
