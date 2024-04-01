<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreLockRequest;
use App\Http\Requests\UpdateLockRequest;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\LockModelResource;
use App\Models\Building;
use App\Models\Lock;
use App\Models\LockModel;
use App\Models\Wrappers\BuildingWrapper;
use App\Models\Wrappers\LockModelWrapper;
use App\Models\Wrappers\LockWrapper;
use Illuminate\Http\Request;
use App\Http\Resources\LockResource;
use App\Models\Keyway;

class LockController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    return view('locks.locklist', [
      'locks' => LockResource::collection(Lock::all()->load(LockWrapper::loadRelationships()))->toArray($request),
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
  public function show(Lock $lock)
  {
    return view('locks.locksingle');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Request $request, Lock $lock)
  {
    return view('locks.lockEdit', [
      'lock' => (new LockResource($lock))->toArray($request),
      'keyways' => Keyway::all()->toArray(),
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
