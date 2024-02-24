<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserGroupRequest;
use App\Models\UserGroup;

class UserGroupController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view ('users.usergroup', [
      'groups' => UserGroup::all()->toArray(),
      'groupsJSON'=> UserGroup::all()->toJson(),
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

    return view ('users.usergroup', [
      'group' => $group->toArray(),
      'groupJSON' => $group->toJson(),
    ]);
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
   */
  public function destroy(UserGroup $group)
  {
    $group->delete();

    return redirect('/groups'); 
  }
}
