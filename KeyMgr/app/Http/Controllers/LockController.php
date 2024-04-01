<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StoreLockRequest;
use App\Http\Requests\UpdateLockRequest;
use App\Models\Lock;
use App\Models\Wrappers\LockWrapper;
use Illuminate\Http\Request;
use App\Http\Resources\LockResource;

class LockController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    return view('locks.locklist', [
      'locks' => LockResource::collection(Lock::all()->load(LockWrapper::loadRelationships()))->toArray($request),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreLockRequest $request)
  {
    //
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
  public function edit(Lock $lock)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateLockRequest $request, Lock $lock)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Lock $lock)
  {
    $lock->destroy();
  }
}
