<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * @todo Create a lock model factory/seeder.
 */
namespace Database\Factories;

use App\Models\Keyway;
use App\Models\LockModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lock>
 */
class LockFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $pinLen = fake()->numberBetween(3, 7);

    return [
      'numPins' => $pinLen,
      'upperPinLengths' => $this->makePinOut($pinLen),
      'lowerPinLengths' => $this->makePinOut($pinLen),
      'installDate' => fake()->dateTimeThisDecade(),
      'keyway_id' => Keyway::all()->random(1)->first()->id,
      'lock_model_id' => LockModel::all()->random(1)->first()->id,
    ];
  }

  private function makePinOut(int $length): string
  {
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= fake()->numberBetween(1, 5);
    }

    return $str;
  }
}
