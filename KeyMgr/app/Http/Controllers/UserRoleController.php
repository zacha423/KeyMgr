<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\UserRoleRequest;
use App\Models\UserRole;

class UserRoleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('users.userrole', [
      'roles' => UserRole::all()->toArray(),
      'rolesJSON' => UserRole::all()->toJson(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('users.userrole'); 
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRoleRequest $request)
  {
    \Log::critical('This is a critical message');
    $validated = $request->safe();
    $role = UserRole::create(['name' => $validated['roleName']]);

    // return view('users.userrole', [
    //   'role' => $role->toArray(),
    //   'roleJSON' => $role->toJson(),
    // ]);

    return $role->toJson();
  }

  /**
   * Display the specified resource.
   */
  public function show(UserRole $role)
  {
    return view('users.userrole', [
      'role' => $role->toArray(),
      'roleJSON' => $role->toJson(),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(UserRole $role)
  {
    return view('users.userrole', [
      'role' => $role->toArray(),
      'roleJSON' => $role->toJson(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRoleRequest $request, UserRole $role)
  {
    $validated = $request->safe();
    if (isset ($validated['roleName']))
    {
      $role->name = $validated['roleName'];
      $role->save();
    }

    return view('users.userrole');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(UserRole $role)
  {
    $role->delete();
    return redirect('/roles');
  }
}
