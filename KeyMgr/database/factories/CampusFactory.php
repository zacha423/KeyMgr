<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campus>
 */
class CampusFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    if (DB::table('addresses')->count() <= 0) {
      Address::factory()->createMany(3);
    }

    return [
      'name' => fake()->lastName(),
      'address_id' => Address::all()->random(1)->first()->id,
    ];
  }
}
