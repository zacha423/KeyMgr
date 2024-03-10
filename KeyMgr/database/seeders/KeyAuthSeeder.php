<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\KeyAuthorization;
use App\Models\KeyAuthStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class KeyAuthSeeder extends Seeder
{
  use WithoutModelEvents;
  public function run(): void
  {
    // Because the default users aren't yet added to this branch.
    User::factory()->createMany(5)->unique();
    $users = User::all();
    $keyauth = new KeyAuthorization(['agreement' => fake()->text()]);
    $keyauth->key_holder_user_id = $users->random(1)->unique()->first()->id;
    $keyauth->requestor_user_id = $users->random(1)->unique()->first()->id;
    $keyauth->key_auth_status_id = KeyAuthStatus::all()->random(1)->first()->id;
    $keyauth->save();
    $keyauth->keyHolderContacts()->attach($users->random(1)->unique());
  }
}