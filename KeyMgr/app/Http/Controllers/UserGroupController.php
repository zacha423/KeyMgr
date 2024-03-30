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

    // $groups = [];
    // $allGroups = UserGroup::all();

    // foreach ($allGroups as $group) {
    //     $groupData = [
    //         'id' => $group->id,
    //         'name' => $group->name
    //     ];

    //     array_push($groups, $groupData);
    // }

    // $groupsArray = $allGroups->toArray();

    // $data = [
    //     'groups' => $groups,
    //     'groupsArray' => $groupsArray
    // ];    
    
    // return view ('users.usergroup', $data);

    $groupIDs = $request->query('groups');

    $groups = [];
    foreach (GroupResource::collection(UserGroup::all())->toArray($request) as $group) {
      $groups[$group['id']] = $group['name'];
    }

    return view ('users.usergroup', [
      'groups' => UserGroup::all()->toArray(),
    ]);   
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view ('users.usergroup', [
      'groups' => UserGroup::all()->toArray(),
      'groupsJSON'=> UserGroup::all()->toJson(),
    ]);   
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserGroupRequest $request)
  {
    $validated = $request->safe();
    $group = UserGroup::find($validated['parentGroup'])->children()->save(
      new UserGroup(['name' => $validated['groupName']])
    );

    // return view ('users.usergroup', [
    //   'group' => $group->toArray(),
    //   'groupJSON' => $group->toJson(),
    // ]);
    return redirect('/groups');
  }

  /**
   * Display the specified resource.
   */
  public function show(UserGroup $group)
  {
    return view ('users.usergroup', [
      'group' => $group->load('children')->toArray(),
      'groupJSON' => $group->load('children')->toJson(),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(UserGroup $group)
  {
    return view ('users.usergroup', [
      'group' => $group->load('children')->toArray(),
      'groupJSON' => $group->load('children')->toJson(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserGroupRequest $request, UserGroup $group)
  {
    $validated = $request->safe();
    $mapped = [];
    if(isset($validated['groupName']))
    {
      $group->name = $validated['groupName'];
      $mapped['name']= $validated['groupName'];
    }

    if (isset($validated['parentGroup']))
    {
      $group->parent_id_fk = $validated['parentGroup'];
      $mapped['parent_id_fk']=$validated['parentGroup'];
    }
    
    // $group->update($mapped);
    $group->save();

    return view ('users.usergroup', [
      'group' => $group->load('children')->toArray,
      'groupJSON' => $group->load('children')->toJson(),
    ]);
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
