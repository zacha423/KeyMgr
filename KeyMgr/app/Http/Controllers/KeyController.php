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
use Illuminate\Http\Request;

class KeyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('key.keys', [
      'keys' => KeyResource::collection(Key::all())->toArray(new Request ()),
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
    return view ('key.keyCreate');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreKeyRequest $request)
  {
    $validated = $request->safe();

    $key = Key::firstOrNew ([
      'keyLevel' => $validated['keyLevel'],
      'keySystem' => $validated['keySystem'],
      'copyNumber' => $validated['copyNumber'],
      'bitting'  => $validated['bitting'],
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

    return redirect()->route('key.index')->with(['status'=>'Successfully saved key.']);
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
    return view('key.editKey');
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateKeyRequest $request, Key $key)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Key $key)
  {
    //
  }
}
