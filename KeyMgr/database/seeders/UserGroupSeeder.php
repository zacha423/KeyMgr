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
    foreach (UserGroup::factory()->createMany (2)->unique() as $group)
    {
      $group->children()->saveMany (UserGroup::factory(2)->create()->unique());
    }

    UserGroup::factory()->createMany(1)->unique();
  }
}
