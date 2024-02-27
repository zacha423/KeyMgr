<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Campus;
use App\mOdels\Address;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Building>
 */
class BuildingFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    if (DB::table('campuses')->count() <= 0)
    {
      Campus::factory()->createMany(3);
    }
    return [
      'name' => fake()->unique()->lastName(),
      'campus_id' => Campus::all()->random(1)->first()->id,
      'address_id' => Address::all()->random(1)->first()->id,
    ];
  }
}
