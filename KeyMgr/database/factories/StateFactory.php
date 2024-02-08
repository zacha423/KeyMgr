<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\State>
 */
class StateFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    if (DB::table('countries')->count() <= 0) {
      Country::factory()->createMany(3);
    }

    return [
      'name' => fake()->state(),
      'abbreviation' => fake()->stateAbbr(),
      'country_id' => Country::all()->random(1)->first()->id,
    ];
  }
}
