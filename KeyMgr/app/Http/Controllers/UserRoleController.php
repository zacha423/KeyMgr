<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\UserRoleRequest;
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

    foreach (RoleResource::collection($allRoles)->toArray($request) as $role) {
      $btnEdit = '<a href="' . route('roles.show', $role['id']) .
        '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
          <i class="fa fa-lg fa-fw fa-pen"></i>
          </a>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-campus-id="'
        . $role['id'] . '">
          <i class="fa fa-lg fa-fw fa-trash"></i>
          </button>';
      $btnDetails = '<a href="' . route('roles.show', $role['id']) .
        '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';

      $roleData = [
        'name' => $role['name'],
        'id' => $role['id'],
        '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
      ];

      array_push($roles, $roleData);
    }

    $rolesArray = [];
    foreach ($allRoles as $role)
    {
      $rolesArray[$role['id']] = $role['name'];
    }
    $data = [
      'roles' => $roles,
      'rolesArray' => $rolesArray
    ];

    return view('users.userrole', $data);




    // return view('users.userrole', [
    //   'roles' => UserRole::all()->toArray(),
    //   'rolesJSON' => UserRole::all()->toJson(),
    // ]);
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
}
