<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\PostalCode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
  const DEFAULT_GEN = 3; // The amount of pre-req items to generate.
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    if (DB::table('cities')->count() <= 0) {
      City::factory()->createMany(3);
    }
    if (DB::table('postal_codes')->count() <= 0) {
      PostalCode::factory()->createMany(3);
    }
    
    return [
      'streetAddress' => fake()->streetAddress(),
      'city_id' => City::all()->random(1)->first()->id,
      'postal_code_id' => PostalCode::all()->random(1)->first()->id,
    ];
  }
}
