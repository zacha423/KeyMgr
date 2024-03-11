<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\IssuedKey;
use App\Models\KeyAuthorization;
use App\Models\KeyAuthStatus;
use App\Models\MessageTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Key;

class KeyAuthSeeder extends Seeder
{
  use WithoutModelEvents;
  public function run(): void
  {
    $users = User::all();
    $agreements = KeyAuthorization::factory()->createMany(5);

    foreach ($agreements as $agreement) {
      $agreement->save();
      $agreement->keyHolderContacts()->attach($users->random(1)->unique());
      $agreement->issuedKeys()->attach(Key::all()->random(1)->first()->id);
      IssuedKey::where([
        'key_authorization_id' => $agreement->id
      ])->get()->first()->messages()->attach(
        MessageTemplate::all()->random(1)->first()->id
      );
    }
  }
}