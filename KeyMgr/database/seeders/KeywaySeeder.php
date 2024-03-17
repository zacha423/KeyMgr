<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\Keyway;
use Illuminate\Database\Seeder;

class KeywaySeeder extends Seeder
{
  public function run(): void
  {
    Keyway::create(['name' => 'Keyway A']);
    Keyway::create(['name' => 'Keyway B']);
    Keyway::create(['name' => 'Keyway C']);
  }
}