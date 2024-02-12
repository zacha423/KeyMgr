<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Door>
 */
class DoorFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    if (DB::table('rooms')->count() <= 0) {
      Room::factory()->createMany(5);
    }

    return [
      'description' => '',
      'hardwareDescription' => '',
      'room_id' => Room::all()->random(1)->first()->id,
    ];
  }
}
