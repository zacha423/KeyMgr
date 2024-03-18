<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreKeyRequest;
use App\Http\Requests\UpdateKeyRequest;
use App\Models\Key;
use App\Models\KeyStatus;
use App\Models\KeyStorage;
use App\Models\KeyType;
use App\Models\Keyway;
use App\Models\Building;
use App\Models\Room;
use App\Models\Door;
use App\Http\Resources\KeyResource;
use App\Models\StorageHook;
use Illuminate\Http\Request;

class KeyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('key.keys', [
      'keys' => KeyResource::collection(Key::all())->toArray(new Request()),
      'keyStatuses' => KeyStatus::all(),
      'keyStorages' => KeyStorage::all(),
      'keyTypes' => KeyType::all(),
      'keyways' => Keyway::all(),
      'buildings' => Building::with('rooms.doors')->get(),
      'rooms' => Room::with('doors')->get(),
      'doors' => Door::all(),
    ]);
  }


  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('key.keyCreate', [
      'key_statuses' => KeyStatus::all()->toArray(),
      'key_types' => KeyType::all()->toArray(),
      'keyways' => Keyway::all()->toArray(),
      'key_storages' => KeyStorage::all()->toArray(),
      'storage_hooks' => StorageHook::all()->toArray(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreKeyRequest $request)
  {
    $validated = $request->safe();

    $key = Key::firstOrNew([
      'keyLevel' => $validated['keyLevel'],
      'keySystem' => $validated['keySystem'],
      'copyNumber' => $validated['copyNumber'],
      'bitting' => $validated['bitting'],
      'blindCode' => $validated['blindCode'],
      'mainAngles' => $validated['mainAngles'],
      'doubleAngles' => $validated['doubleAngles'],
      'replacementCost' => $validated['replacementCost'],
    ]);
    $key->key_status_id = $validated['key_status_id'];
    $key->keyway_id = $validated['keyway_id'];
    $key->key_type_id = $validated['key_type_id'];
    $key->storage_hook_id = $validated['storage_hook_id'];

    $key->save();

    return redirect()->route('key.index')->with(['status' => 'Successfully saved key.']);
  }

  /**
   * Display the specified resource.
   */
  public function show(Key $key)
  {
    return view('key.singleKey', [
      'key' => (new KeyResource($key))->toArray(new Request()),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Key $key)
  {
    return view('key.editKey', [
      'key_statuses' => KeyStatus::all()->toArray(),
      'key_types' => KeyType::all()->toArray(),
      'keyways' => Keyway::all()->toArray(),
      'key_storages' => KeyStorage::all()->toArray(),
      'storage_hooks' => StorageHook::all()->toArray(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateKeyRequest $request, Key $key)
  {
    $validated = $request->safe();

    if (isset ($validated['keyLevel'])) {
      $key->keyLevel = $validated['keyLevel'];
    }
    if (isset ($validated['keySystem'])) {
      $key->keySystem = $validated['keySystem'];
    }
    if (isset ($validated['copyNumber'])) {
      $key->copyNumber = $validated['copyNumber'];
    }
    if (isset ($validated['bitting'])) {
      $key->bitting = $validated['bitting'];
    }
    if (isset ($validated['blindCode'])) {
      $key->blindCode = $validated['blindCode'];
    }
    if (isset ($validated['mainAngles'])) {
      $key->mainAngles = $validated['mainAngles'];
    }
    if (isset ($validated['doubleAngles'])) {
      $key->doubleAngles = $validated['doubleAngles'];
    }
    if (isset ($validated['replacementCost'])) {
      $key->replacementCost = $validated['replacementCost'];
    }
    if (isset ($validated['key_status_id'])) {
      $key->key_status_id = $validated['key_status_id'];
    }
    if (isset ($validated['keyway_id'])) {
      $key->keyway_id = $validated['keyway_id'];
    }
    if (isset ($validated['key_type_id'])) {
      $key->key_type_id = $validated['key_type_id'];
    }
    if (isset ($validated['storage_hook_id'])) {
      $key->storage_hook_id = $validated['storage_hook_id'];
    }

    $key->save();
    
    return redirect()->route('key.show', $request->route('key'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Key $key)
  {
    $key->delete();
    return redirect()->route('key.index');
  }
}
