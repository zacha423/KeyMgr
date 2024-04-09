<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lock;

class LockSeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Lock::factory()->createMany(25)->unique();
  }
}
