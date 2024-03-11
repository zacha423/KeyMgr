<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Factories;

use App\Models\KeyStatus;
use App\Models\Keyway;
use App\Models\StorageHook;
use App\Models\KeyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Key>
 */
class KeyFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'keyLevel' => fake()->text(5),
      'keySystem' => fake()->numberBetween(1, 100),
      'copyNumber' => fake()->numberBetween(1, 30),
      'key_status_id' => KeyStatus::all()->random(1)->first()->id,
      'keyway_id' => Keyway::all()->random(1)->first()->id,
      'storage_hook_id' => StorageHook::all()->random(1)->first()->id,
      'key_type_id' => KeyType::all()->random()->first()->id,
    ];
  }
}
