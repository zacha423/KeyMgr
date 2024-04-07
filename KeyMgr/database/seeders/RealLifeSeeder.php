<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserGroup;

class RealLifeSeeder extends Seeder
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
      ['name' => 'Undergraduate Students'],
      ['name' => 'Graduate Students'],
      ['name' => 'Staff'],
      ['name' => 'Faculty'],
    ]);

    $CAS = UserGroup::create(['name' => 'College or Arts and Sciences']);
    $SNS = new UserGroup (['name' => 'School of Natural Sciences']);
    $SNS->parent_id_fk = $CAS->id;
    $SNS->save();

    $SNS->children()->saveMany(UserGroup::factory()->createMany([
      ['name' => 'Mathematics'],
      ['name' => 'Computer Science'],
      ['name' => 'Data Science'],
      ['name' => 'Bio-Informatics'],
    ]));
  }
}
