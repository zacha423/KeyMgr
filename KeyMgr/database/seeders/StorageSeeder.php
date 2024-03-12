<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use App\Models\KeyStorage;
use App\Models\StorageHook;

class StorageSeeder extends Seeder
{
  public function run(): void
  {
    $store = new KeyStorage(['name'=>'Cabinet']);
    $store->room_id = Room::all()->random(1)->first()->id;
    $store->save();
    $hook = new StorageHook(['rowNum' => 1, 'colNum' => 1]);
    $hook->key_storage_id = $store->id;
    $hook->save();
  }
}