<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\UserGroupRequest;
use App\Models\UserGroup;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\GroupResource;
use App\Http\Requests\RoleAssignmentRequest;
use App\Http\Resources\UserResource;

class UserGroupController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $datatableData = [];
    $groupSearchResults = UserGroup::with('parent');

    if($request->query('groups'))
    {
      $groupSearchResults->whereHas('parent', function ($query) use ($request) {
        $query->whereIn('id', $request->query('groups'));
      });
    }
    
    $groupSearchResults = $groupSearchResults->get();

    foreach (($groupSearchResults) as $group) {
      $groupRes = (new GroupResource ($group))->toArray($request);
      $btnEdit = '<a href="' . route('groups.edit', $groupRes['id']) .
        '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
          <i class="fa fa-lg fa-fw fa-pen"></i>
          </a>';
      $btnDelete = '<button disabled class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-group-id="'
        . $groupRes['id'] . '">
          <i class="fa fa-lg fa-fw fa-trash"></i>
          </button>';
      $btnDetails = '<a href="' . route('groups.show', $groupRes['id']) .
        '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';

      array_push($datatableData, [
        $groupRes['id'],
        $groupRes['name'],
        $groupRes['parentName'] ? $groupRes['parentName'] : ' ',
        $group->users()->count(),
        $group->roles()->count(),
      '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>']);
    }

    $groupsArray = [];
    foreach (UserGroup::all() as $groupRes)
    {
      $groupsArray[$groupRes['id']] = $groupRes['name'];
    }
    $data = [
      'groups' => $datatableData,
      'groupsArray' => $groupsArray,
      'selected' => $request->query('groups'),
    ];

    return view('users.usergroup', $data);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {
    return view('users.usergroup', [
      'groups' => GroupResource::collection(UserGroup::all())->toArray($request),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserGroupRequest $request)
  {
    $validated = $request->safe();
    UserGroup::find($validated['parentGroup'])->children()->save(
      new UserGroup(['name' => $validated['groupName']])
    );

    return redirect('/groups');
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, UserGroup $group)
  {
    $users = $group->users()->get();
    $usersTableData = [];

    foreach ($users as $user)
    {
      $u = new UserResource ($user);
      array_push($usersTableData, [$u['id'], $u['firstName'], $u['lastName'], '<a href="' . route('users.show', $u['id']) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>']);
    }


    $allGroups = UserGroup::all()->load('parent');

    $groupsArray = [];
    foreach ($allGroups as $agroup)
    {
      $groupsArray[$agroup['id']] = $agroup['name'];
    }

    return view('users.groupShow', [
      'group' => $group->load('children')->load('parent')->toArray(),
      'groups' => $groupsArray,
      'users' => $usersTableData,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(UserGroup $group)
  {
    $users = $group->users()->get();
    $usersTableData = [];

    foreach ($users as $user)
    {
      $u = new UserResource ($user);
      array_push($usersTableData, [$u['id'], $u['firstName'], $u['lastName'], '<a href="' . route('users.show', $u['id']) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
            </a>']);
    }


    $allGroups = UserGroup::all()->load('parent');

    $groupsArray = [];
    foreach ($allGroups as $agroup)
    {
      $groupsArray[$agroup['id']] = $agroup['name'];
    }

    return view('users.groupShow', [
      'group' => $group->load('children')->load('parent')->toArray(),
      'groups' => $groupsArray,
      'users' => $usersTableData,
      'open' => 'true',
    ]);
    // $allGroups = UserGroup::all()->load('parent');

    // $groupsArray = [];
    // foreach ($allGroups as $agroup)
    // {
    //   $groupsArray[$agroup['id']] = $agroup['name'];
    // }

    // return view('users.groupShow', [
    //   'group' => $group->load('children')->load('parent')->toArray(),
    //   'groups' => $groupsArray,
    //   'open' => 'true',
    // ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserGroupRequest $request, UserGroup $group)
  {
    $validated = $request->safe();

    if (isset($validated['name'])) {
      $group->name = $validated['name'];
    }

    if (isset($validated['parentGroup'])) {
      $group->parent_id_fk = $validated['parentGroup'];
    }

    $group->save();

    return redirect('/groups');
  }

  /**
   * Remove the specified resource from storage.
   * 
   * @todo Decide behavior for deleting a parent group
   */
  public function destroy(UserGroup $group)
  {
    $group->delete();

    return redirect('/groups');
  }

  public function manageRoles(RoleAssignmentRequest $request)
  {
    $validated = $request->safe();

    $roles = UserRole::find($validated['roles']);
    $groups = UserGroup::find($validated['selectedGroups']);

    foreach ($groups as $group)
    {
      if(isset($validated['addMode'])) {
        $group->roles()->attach($roles);
      }
      else {
        $group->roles()->detach($roles);
      }
    }

    return redirect()->route('groups.store');
  }
}
