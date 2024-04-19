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
    Keyway::create(['name' => 'KW1']);
    Keyway::create(['name' => 'KW10']);
    Keyway::create(['name' => 'KS']);

    $SchlageKeyways = [
      'L','H','J','K','C','CE','E','EF','F','FG','G',
    ];

    foreach ($SchlageKeyways as $keyway)
    {
      KeyWay::create(['name' => $keyway]);
    }
  }
}