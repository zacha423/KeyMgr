<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Factories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LockModel>
 */
class LockModelFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'manufacturer_id' => Manufacturer::all()->random(1)->first()->id,
      'MACS' => fake()->numberBetween(3, 7),
      'name' => fake()->unique()->firstName(),
    ];
  }
}
