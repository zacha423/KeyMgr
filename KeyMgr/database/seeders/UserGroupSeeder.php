<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserGroup;

class UserGroupSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $NatSci = UserGroup::factory()->create (['name' => 'School of Natural Sciences']);
    
    UserGroup::factory()->createMany ([
      ['name'=>'Computer Science'],
      ['name'=>'Mathematics']
    ])->each (function ($subdepartment) {
      $NatSci = UserGroup::find(1);
      $subdepartment->parent()->associate($NatSci)->save();
    });
    

    // $Departments = UserGroup::factory()->createMany([
    //   ['name'=> 'Computer Science'],
    //   ['name'=> 'Mathematics'],
    // ]);

    // $NatSci->children()->saveMany($Departments);
    // foreach ($Departments as $department) {
    //   $department->parent()->save($NatSci);
    // }

    UserGroup::factory()->createMany([
      ['name' => 'Undergraduate Students'],
      ['name' => 'Staff'],
      ['name' => 'Faculty'],
    ]);
  }
}
