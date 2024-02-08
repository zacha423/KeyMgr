<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\State;
use app\models\Country;
use Illuminate\Support\Facades\DB;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
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
    if (DB::table('states')->count() <= 0) {
      State::factory()->createMany(3);
    }

    return [
      'name' => fake()->city(),
      'state_id' => 1,
    ];
  }
}
