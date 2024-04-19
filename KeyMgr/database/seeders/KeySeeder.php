<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Key;
use App\Models\Lock;

class KeySeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    foreach (Key::factory()->createMany(15) as $key) {
      $key->openableLocks()->attach(Lock::inRandomOrder(1)->first()->id);
      $key->save();
    }
  }
}
