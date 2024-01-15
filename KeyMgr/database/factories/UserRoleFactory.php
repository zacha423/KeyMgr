<?php

namespace Database\Factories;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRole>
 */
class UserRoleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name' => fake()->name()
    ];
  }

  /**
   * The name of the factory's corresponding model.
   * 
   * @var class-string<\Illuminate\Database\Eloquent\Model>
   */
  protected $model = UserRole::class;
}
//https://laracasts.com/discuss/channels/laravel/pass-parameter-to-factory