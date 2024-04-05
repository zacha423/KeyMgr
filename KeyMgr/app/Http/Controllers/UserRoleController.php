<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\GroupAssignmentRequest;
use App\Http\Requests\UserRoleRequest;
use App\Models\UserGroup;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;

class UserRoleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $roles = [];
    $allRoles = UserRole::all();
    $rolesArray = [];

    foreach ($allRoles as $role) {
      $btnEdit = '<a href="' . route('roles.show', $role->id) .
        '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
          <i class="fa fa-lg fa-fw fa-pen"></i>
          </a>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-role-id="'
        . $role->id . '">
          <i class="fa fa-lg fa-fw fa-trash"></i>
          </button>';
      $btnDetails = '<a href="' . route('roles.show', $role->id) .
        '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';

      $roleData = [
        $role->id,
        $role->name,
        $role->users()->count(),
        $role->groups()->count(),
        '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
      ];

      array_push($roles, $roleData);
    }

    
    foreach ($allRoles as $role)
    {
      $rolesArray[$role->id] = $role->name;
    }

    return view('users.userrole', [
      'roles' => $roles,
      'rolesArray' => $rolesArray
    ]);

  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRoleRequest $request)
  {
    $validated = $request->safe();
    $role = UserRole::create(['name' => $validated['roleName']]);

    return redirect('/roles');
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, UserRole $role)
  {
    $users = $role->users()->get();
    $usersTableData = [];
    foreach ($users as $user)
    {
      $u = new UserResource ($user);
      array_push($usersTableData, [$u['id'], $u['firstName'], $u['lastName'], '<a href="' . route('users.show', $u['id']) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>']);
    }


    return view('users.roleShow', [
      'role' => $role->toArray(),
      'roleJSON' => $role->toJson(),
      'users' => $usersTableData,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(UserRole $role)
  {
    return view('users.roleShow', [
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

  public function manageGroups (GroupAssignmentRequest $request) {
    $validated = $request->safe();

    $groups = UserGroup::find($validated['groups']);
    $roles = UserRole::find($validated['selectedRoles']);

    foreach ($roles as $role)
    {
      if (isset ($validated['addMode']))
      {
        $role->groups()->attach($groups);
      }
      else {
        $role->groups()->detach($groups);
      }
    }

    return redirect()->route('roles.index');
  }
}
