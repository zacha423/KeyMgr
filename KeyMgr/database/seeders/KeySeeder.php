<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use App\Models\KeyStatus;
use App\Models\KeyType;
use App\Models\Keyway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Key;
use App\Models\StorageHook;

class KeySeeder extends Seeder
{
  use WithoutModelEvents;
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $key = new Key(['keyLevel'=>'ACE', 'keySystem'=>'20']);
    $key->key_status_id = KeyStatus::all()->random(1)->first()->id;
    $key->key_type_id = KeyType::all()->random(1)->first()->id;
    $key->keyway_id = Keyway::all()->random(1)->first()->id;
    $key->storage_hook_id = StorageHook::all()->random(1)->first()->id;
  }
}
