<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreLockRequest;
use App\Http\Requests\UpdateLockRequest;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\LockModelResource;
use App\Http\Resources\LockResource;
use App\Models\Building;
use App\Models\Keyway;
use App\Models\Lock;
use App\Models\LockModel;
use App\Models\Wrappers\BuildingWrapper;
use App\Models\Wrappers\LockModelWrapper;
use App\Models\Wrappers\LockWrapper;
use App\Models\Room;
use Illuminate\Http\Request;

class LockController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {

    $data = [];
    $allLocks = Lock::all()->load(LockWrapper::loadRelationships());

    foreach ($allLocks as $lock) {
      $lockRes = (new LockResource($lock))->toArray($request);

      $btnEdit = '<a href="' . route('locks.edit', $lock->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
      <i class="fa fa-lg fa-fw fa-pen"></i>
      </a>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-key-id="' . $lock->id . '">
            <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';
      $btnDetails = '<a href="' . route('locks.show', $lock->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
      </a>';

      array_push($data, [
        'id' => $lock->id,
        'numPins' => $lockRes['numPins'],
        'installDate' => date('m/d/Y', strtotime($lockRes['installDate'])),
        'keyway' => $lockRes['keyway'],
        'keyway_id' => $lockRes['keyway_id'],
        'buildingName' => $lock->building()->name,
        'roomName' => $lock->getRoom()->number,
        'actions' => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
      ]);
    }
    return view('locks.locklist', [
      'data' => $data,
      'buildings' => BuildingResource::collection(Building::all()->load(BuildingWrapper::loadRelationships()))->toArray($request),
      'keyways' => Keyway::all()->toArray(),
      'models' => LockModelResource::collection(LockModel::all()->load(LockModelWrapper::loadRelationships()))->toArray($request),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreLockRequest $request)
  {
    $data = $request->validated;

    $lock = Lock::firstOrNew([
      'numPins' => $data['numPins'],
      'upperPinLengths' => $data['upperPinLengths'],
      'lowerPinLengths' => $data['lowerPinLengths'],
      'installDate' => date('m/d/Y', strtotime($data['installDate'])),
      'keyway_id' => $data['keyway_id'],
      'manufacturer_id' => $data['manufacturer_id'],
    ]);

    $lock->save();

    return redirect()->route('locks.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, Lock $lock)
  {
    $lock->load(LockWrapper::loadRelationships());

    return view('locks.locksingle', [
      'lockRes' => (new LockResource($lock))->toArray($request),
      'buildingName' => $lock->building()->name,
      'roomName' => $lock->getRoom()->number,
      'lock' => (new LockResource($lock))->toArray($request),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Request $request, Lock $lock)
  {
    $buildings = [];
    $rooms = [];

    foreach (Building::all() as $building) {
      $buildingRes = (new BuildingResource($building))->toArray($request);
      $buildings[$buildingRes['id']] = $buildingRes['name'];
    }
    
    $lock->load([
      'door' => [
        'room' => [
          'building'
        ],
      ]
    ]);

    foreach ($lock->door->room->building->rooms()->get() as $room)
    {
      $rooms[$room->id] = $room->number;
    }

    return view('locks.lockEdit', [
      'lock' => (new LockResource($lock))->toArray($request),
      'buildings' => $buildings,
      'rooms' => $rooms,
      'keyways' => Keyway::all()->toArray(),
      'models' => LockModel::all()->pluck('name', 'id')->toArray(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateLockRequest $request, Lock $lock)
  {
    $data = $request->validated();

    if (isset($data['numPins'])) {
      $lock->numPins = $data['numPins'];
    }
    if (isset($data['upperPinLengths'])) {
      $lock->upperPinLengths = $data['upperPinLengths'];
    }
    if (isset($data['lowerPinLengths'])) {
      $lock->lowerPinLengths = $data['lowerPinLengths'];
    }
    if (isset($data['installDate'])) {
      $lock->installDate = $data['installDate'];
    }
    if (isset($data['keyway_id'])) {
      $lock->keyway_id = $data['keyway_id'];
    }
    if (isset($data['room'])) {
      $lock->door_id = Room::find($data['room'])->doors()->first()->id;
    }
    // Save the changes to the lock
    $lock->save();

    // Redirect to the lock's show page
    return redirect()->route('locks.show', ['lock' => $lock->id])->with('status', 'Lock updated successfully.');
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Lock $lock)
  {
    $lock->delete();
  }

  public function getRooms(Request $request)
  {


    $buildingID = $request->input('building_id');
    $rooms = Room::where('building_id', $buildingID)->get()->pluck('number', 'id')->toArray();

    return view('locks.partials.roomOptions', ['options' => $rooms])->render();

    // return response()->json($rooms);
  }

}
