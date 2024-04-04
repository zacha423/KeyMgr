<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Controllers;

use App\Http\Requests\UserGroupRequest;
use App\Models\UserGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\GroupResource;

class UserGroupController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $groups = [];
    $allGroups = UserGroup::all()->load('parent');

    foreach (GroupResource::collection($allGroups)->toArray($request) as $group) {
      $btnEdit = '<a href="' . route('groups.edit', $group['id']) .
        '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
          <i class="fa fa-lg fa-fw fa-pen"></i>
          </a>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-campus-id="'
        . $group['id'] . '">
          <i class="fa fa-lg fa-fw fa-trash"></i>
          </button>';
      $btnDetails = '<a href="' . route('groups.show', $group['id']) .
        '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';

      $groupData = [
        'id' => $group['id'],
        'name' => $group['name'],
        'parent_name' => $group['parentName'],
        '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
      ];

      array_push($groups, $groupData);
    }

    $groupsArray = [];
    foreach ($allGroups as $group)
    {
      $groupsArray[$group['id']] = $group['name'];
    }
    $data = [
      'groups' => $groups,
      'groupsArray' => $groupsArray
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
  public function show(UserGroup $group)
  {
    $allGroups = UserGroup::all()->load('parent');

    $groupsArray = [];
    foreach ($allGroups as $agroup)
    {
      $groupsArray[$agroup['id']] = $agroup['name'];
    }

    return view('users.groupShow', [
      'group' => $group->load('children')->load('parent')->toArray(),
      'groups' => $groupsArray,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(UserGroup $group)
  {
    return view('users.usergroup', [
      'group' => $group->load('children')->toArray(),
      'groups' => [],
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserGroupRequest $request, UserGroup $group)
  {
    $validated = $request->safe();

    if (isset($validated['groupName'])) {
      $group->name = $validated['groupName'];
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
}
