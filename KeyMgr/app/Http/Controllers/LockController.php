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
      'installDate' => $data['installDate'],
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
    
    return view('locks.locksingle',[
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
    return view('locks.lockEdit', [
      'lock' => (new LockResource($lock))->toArray($request),
      'buildings' => BuildingResource::collection(Building::all()->load(BuildingWrapper::loadRelationships()))->toArray($request),
      'keyways' => Keyway::all()->toArray(),
      'models' => LockModelResource::collection(LockModel::all()->load(LockModelWrapper::loadRelationships()))->toArray($request),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateLockRequest $request, Lock $lock)
  {
    $data = $request->validated;


    $lock->numPins = $data['numPins'];
    $lock->upperPinLengths = $data['upperPinLengths'];
    $lock->lowerPinLengths = $data['lowerPinLengths'];
    $lock->installDate = $data['installDate'];
    $lock->keyway_id = $data['keyway_id'];
    $lock->manufacturer_id = $data['manufacturer_id'];


    $lock->save();

    return redirect()->route('locks.show', ['lock' => $lock->id]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Lock $lock)
  {
    $lock->delete();
  }
}
