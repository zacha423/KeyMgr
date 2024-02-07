<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
class StateSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $states = [
      ['name' => 'Oregon', 'abbreviation' => 'OR', 'country_id' => 1],
      ['name' => 'Hawaii', 'abbreviation' => 'HI', 'country_id' => 1],
    ];

    State::factory()->createMany ($states);
    // State::factory()->createMany (2);
  }
}
