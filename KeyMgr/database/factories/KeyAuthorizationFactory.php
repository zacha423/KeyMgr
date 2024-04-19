<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Factories;

use App\Models\KeyAuthStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KeyAuthorization>
 */
class KeyAuthorizationFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    if (DB::table('users')->count() <= 0)
    {
      User::factory()->createMany (5);
    }

    $users = User::all();

    return [
      'key_holder_user_id' => $users->random(1)->unique()->first()->id,
      'requestor_user_id' => $users->random(1)->unique()->first()->id,
      'key_auth_status_id' => KeyAuthStatus::all()->random(1)->first()->id,
    ];
  }
}
