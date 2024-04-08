<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manufacturer;
use App\Models\LockModel;

class LockModelSeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $kwikset = Manufacturer::firstOrCreate(['name' => 'Kwikset']);

    LockModel::firstOrNew (['MACS' => 4, 'name' => 'Kwikset Classic', 'manufacturer_id' => $kwikset->id,])->save();
    LockModel::firstOrNew (['MACS' => 4, 'name' => 'Kwikset Titan', 'manufacturer_id' => $kwikset->id,])->save();
    LockModel::firstOrNew (['MACS' => 4, 'name' => 'Kwikset SmartKey', 'manufacturer_id' => $kwikset->id,])->save();

    LockModel::factory()->createMany(10)->unique();
  }
}

