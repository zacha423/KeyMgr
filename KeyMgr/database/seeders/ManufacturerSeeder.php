<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Manufacturer::factory()->createMany([
      ['name' => 'Medeco'],
      ['name' => 'Kwikset'],
      ['name' => 'Arrow'],
      ['name' => 'Schalge'],
    ]);

    Manufacturer::factory()->createMany(5);
  }
}
