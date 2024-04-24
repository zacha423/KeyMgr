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
    $keyway = Keyway::inRandomOrder()->first();
    return [
      'keyLevel' => $this->level(),
      'keySystem' => fake()->numberBetween(1, 31),
      'copyNumber' => fake()->numberBetween(1, 30),
      'key_status_id' => KeyStatus::all()->random(1)->first()->id,
      'keyway_id' => $keyway->id,
      // 'storage_hook_id' => StorageHook::all()->random(1)->first()->id,
      'key_type_id' => KeyType::all()->random()->first()->id,
      'bitting' => $this->bitting(),
    ];
  }

  /**
   * Force the key to be loaded with the unassigned status.
   */
  public function unassigned(): Factory
  {
    return $this->state(function (array $attributes) {
      return [
        'key_status_id' => KeyStatus::where([
          'name' => config('constants.keys.statuses.unassigned.name')
        ])->first()->id,
      ];
    });
  }

  protected function level(): string {
    $str = '';
    
    for($i = 0; $i < fake()->numberBetween(1, 3); $i++) {
      $str = $str . fake()->randomLetter();
    }

    return strtoupper($str);
  }

  protected function bitting(): string {
    $str = '';
    $lim = fake()->numberBetween(5, 7);

    for($i = 0; $i < $lim; $i++){
      $str = $str . fake()->numberBetween(0, 5);
    }

    return $str;
  }
}
