<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserGroup;

class PacUSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    UserGroup::factory()->createMany([
      ['name' => 'University Information Services'],
      ['name' => 'Facilities'],
      ['name' => 'Mail Services'],
    ]);

    $CAS = UserGroup::create(['name' => 'College or Arts and Sciences']);
    $SNS = new UserGroup (['name' => 'School of Natural Sciences']);
    $SNS->parent_id_fk = $CAS->id;
    $SNS->save();
  }
}
