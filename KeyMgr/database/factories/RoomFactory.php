<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Building;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    if (DB::table('buildings')->count() <= 0) 
    {
      Building::factory()->createMany (3);
    }

    return [
      'number' => fake()->buildingNumber(),
      'description' => fake()->randomAscii(),
      'building_id' => Building::all()->random(1)->first()->id,
    ];
  }
}
