<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Door;

class DoorSeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    foreach (Room::all() as $room) {
      $room->doors()->saveMany(Door::factory()->createMany(2));
    }
  }
}
