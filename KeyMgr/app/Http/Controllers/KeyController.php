<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreKeyRequest;
use App\Http\Requests\UpdateKeyRequest;
use App\Models\Key;
use App\Models\KeyAuthorization;
use App\Models\KeyStatus;
use App\Models\KeyStorage;
use App\Models\KeyType;
use App\Models\Keyway;
use App\Models\Building;
use App\Models\Room;
use App\Models\Door;
use App\Models\User;
use App\Http\Resources\KeyResource;
use App\Models\StorageHook;
use Illuminate\Http\Request;
use DateTime;

class KeyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $keys = Key::with('keyway', 'type');

    if ($request->query('building')) {
      $keys->whereHas('openableLocks.door.room.building', function ($query) use ($request) {
        $query->where('id', $request->query('building'));
      });
    }

    if ($request->query('room')) {
      $keys->whereHas('openableLocks.door.room', function ($query) use ($request) {
        $query->where('id', $request->query('room'));
      });
    }

    if ($request->query('statuses')) {
      $keys->whereHas('status', function ($query) use ($request) {
        $query->whereIn('key_status_id', $request->query('statuses'));
      });
    }

    if ($request->query('keyways')) {
      $keys->whereHas('keyway', function ($query) use ($request) {
        $query->whereIn('keyway_id', $request->query('keyways'));
      });
    }

    $data = [];

    foreach (KeyResource::collection($keys->get())->toArray($request) as $key) {
      $btnEdit = '<a href="' . route('keys.edit', $key['id']) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
        </button> </a>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-key-id="' . $key['id'] . '">
        <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';
      $btnDetails = '<a href="' . route('keys.show', $key['id']) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
              <i class="fa fa-lg fa-fw fa-eye"></i>
          </button> </a>';

      array_push($data, [
        $key['id'],
        $key['keyLevel'],
        $key['keySystem'],
        $key['copyNumber'],
        $key['bitting'],
        $key['replacementCost'],
        $key['status'],
        $key['keyway'],
        '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
      ]);
    }

    $users = [];
    foreach (User::all() as $user) {
      $users[$user->id] = $user->getFullName();
    }

    return view('key.keys', [
      'keys' => $data,
      'keyStatuses' => KeyStatus::all()->pluck('name', 'id')->toArray(),
      'keyways' => Keyway::all()->pluck('name', 'id')->toArray(),
      'buildings' => Building::all()->pluck('name', 'id')->toArray(),
      'rooms' => Room::with('doors')->get(),
      'users' => $users,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('key.keyCreate', [
      'keyStatuses' => KeyStatus::all()->toArray(),
      'keyTypes' => KeyType::all()->toArray(),
      'keyways' => Keyway::all()->toArray(),
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
      'replacementCost' => $validated['replacementCost'],
    ]);
    $key->key_status_id = $validated['key_status_id'];
    $key->keyway_id = $validated['keyway_id'];

    $key->save();

    return redirect()->route('keys.index')->with(['status' => 'Successfully saved key.']);
  }

  /**
   * Display the specified resource.
   */
  public function show(Key $key)
  {
    $authorized = KeyAuthorization::whereHas('issuedKeys', function ($query) use ($key) {
      $query->where(['keys.id' => $key->id]);
    })->orderBy('created_at', 'DESC')->first();

    $hold = [];
    $hold['auth'] = $authorized->id;
    $hold['holder'] = $authorized->keyHolder()->first()->getFullname();
    $hold['holderID'] = $authorized->keyHolder()->first()->id;
    $hold['dueDate'] = $authorized->issuedKeys()->where(['keys.id' => $key->id])->first()->pivot->due_date;


    $locks = [];
    foreach ($key->openableLocks()->with('lockModel')->get() as $lock) {
      array_push ($locks, [
        $lock->id,
        $lock->lockModel->name,
        explode(' ', $lock->installDate)[0],
        '<a href="' . route('locks.show', $lock->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="View Lock">
              <i class="fa fa-lg fa-fw fa-eye"></i>
          </button> </a>',
      ]);
    }
    return view('key.singleKey', [
      'key' => (new KeyResource($key))->toArray(new Request()),
      'holder' => $hold,
      'locks' => $locks,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Key $key)
  {
    return view('key.keyEdit', [
      'key' => (new KeyResource($key))->toArray(new Request()),
      'keyStatuses' => KeyStatus::all()->toArray(),
      'keyways' => Keyway::all()->toArray(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateKeyRequest $request, Key $key)
  {
    $validated = $request->safe();

    if (isset($validated['keyLevel'])) {
      $key->keyLevel = $validated['keyLevel'];
    }
    if (isset($validated['keySystem'])) {
      $key->keySystem = $validated['keySystem'];
    }
    if (isset($validated['copyNumber'])) {
      $key->copyNumber = $validated['copyNumber'];
    }
    if (isset($validated['bitting'])) {
      $key->bitting = $validated['bitting'];
    }

    if (isset($validated['replacementCost'])) {
      $key->replacementCost = $validated['replacementCost'];
    }
    if (isset($validated['key_status_id'])) {
      $key->key_status_id = $validated['key_status_id'];
    }
    if (isset($validated['keyway_id'])) {
      $key->keyway_id = $validated['keyway_id'];
    }

    $key->save();

    return redirect()->route('keys.index')->with(['status' => 'Successfully saved key.']);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Key $key)
  {
    $key->delete();
    return redirect()->route('keys.index');
  }
}
