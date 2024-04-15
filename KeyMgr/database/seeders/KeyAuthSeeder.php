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
    $agreements = KeyAuthorization::factory()->createMany(20);

    foreach ($agreements as $indx => $agreement) {
      $agreement->save();
      $agreement->keyHolderContacts()->attach($users->random(1)->unique());
      $key = Key::all()->random(($indx % 4) + 1);
      
      $agreement->issuedKeys()->attach($key);

      foreach ($key as $k)
      {
        $agreement->rooms()->attach($k->room()->id);
      }
      



      IssuedKey::where([
        'key_authorization_id' => $agreement->id
      ])->get()->first()->messages()->attach(
        MessageTemplate::all()->random(1)->first()->id
      );
    }
  }
}