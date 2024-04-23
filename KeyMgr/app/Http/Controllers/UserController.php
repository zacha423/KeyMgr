<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * @author Liam Henry <henr5288@pacificu.edu>
 * 
 * Purpose: This controller can be used for managing user management. 
 * Basic login/authentication should be done through Laravel Breeze's controllers.
 */
namespace App\Http\Controllers;

use App\Http\Requests\GroupMembershipRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\RoleMembershipRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{

  public function index(Request $request)
  {
    $data = [];
    $query = User::with('groups', 'roles');
    $groupIDs = $request->query('groups');
    $roleIDs = $request->query('roles');

    if ($groupIDs) {
      $query->whereHas('groups', function ($query) use ($groupIDs) {
        $query->whereIn('user_group_id', $groupIDs);
      });
    }

    if ($roleIDs) {
      $query->whereHas('roles', function ($query) use ($roleIDs) {
        $query->whereIn('user_role_id', $roleIDs);
      });
    }

    foreach ($query->get() as $user3) {
      $user = (new UserResource($user3));
      $user4 = $user->toArray($request);
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-user-id="'
        . $user->id . '">
          <i class="fa fa-lg fa-fw fa-trash"></i>
          </button>';
      $btnDetails = '<a href="' . route('users.show', $user['id'])
        . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
            </button>';
      $btnEdit = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>';

      array_push($data, [
        $user->id,
        $user->firstName,
        $user->lastName,
        $user->email,
        $user->username,
        implode("<br>", $user4['groups2']),
        implode("<br>", $user4['roles2']),
        '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
      ]);
    }

    return view('users.userlist', [
      'users' => $data,
      'groupOptions' => UserGroup::all()->pluck('name', 'id')->toArray(),
      'roleOptions' => UserRole::all()->pluck('name', 'id')->toArray(),
      'selectedGroups' => $groupIDs,
      'selectedRoles' => $roleIDs,
    ]);
  }

  /**
   * Add a group membership to a set of users.
   * 
   * @todo Determine appropriate return type
   */
  public function groupMembershipManagement (GroupMembershipRequest $request)
  {
    $validated = $request->validated();
    $users = User::find($validated['selectedUsers']);
    $groups = UserGroup::find($validated['selectedData']);

    foreach ($users as $user)
    {
      if (isset($validated['addGroupToggle']))
      {
        $user->groups()->attach($groups);
      }
      else
      {
        $user->groups()->detach($groups);
      }
      
    }

    return redirect()->route('users.index');
  }
  /**
   * Remove a group membership from a set of users
   * 
   * @todo Determine appropriate return type
   */
  public function roleMembershipManagement(RoleMembershipRequest $request): RedirectResponse
  {
    $validated = $request->validated();
    $users = User::find($validated['selectedUsers']);
    $roles = UserRole::find($validated['selectedData']);

    foreach ($users as $user)
    {
      if(isset($validated['addRoleToggle']))
      {
        $user->roles()->attach($roles);
      }
      else
      {
        $user->roles()->detach($roles);
      }
    }
    
    return redirect()->route('users.index');
  }

  public function store(Request $request)
  {
    $request->validate([
      'firstName' => ['required', 'string', 'max:255',],
      'lastName' => ['required', 'string', 'max:255',],
      'username' => ['required', 'unique:App\Models\User,username',],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255'], //email:rfc,dns,spoof
      'password' => ['required', 'confirmed', Rules\Password::defaults()], //, Password::min(self::PW_MIN_LEN)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
    ]);

    $user = User::create([
      'firstName' => $request->firstName,
      'lastName' => $request->lastName,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    $user->roles()->save(UserRole::where(['name' => config('constants.roles.default')])->first());
    $user->groups()->save(UserGroup::where(['name' => config('constants.groups.default')])->first());
    $user->save();

    event(new Registered($user));



    return redirect('/users');
  }

  public function edit(Request $request, User $user): View
  {
    $formatForAdminLTE = function ($rawEloquentCollection) {
      $data = [];
      foreach ($rawEloquentCollection as $item) {
        $data[$item['id']] = $item['name'];
      }

      return $data;
    };

    return view('users.user-edit', [
      'user' => $user,
      'memberRoles' => $formatForAdminLTE((RoleResource::collection($user->roles()->get()))->toArray($request)),
      'memberGroups' => $formatForAdminLTE((GroupResource::collection($user->groups()->get()))->toArray($request)),
    ]);

  }

  /**
   * Important: $request->user() gives you the person making the request, not the user account being modified.
   */
  public function update(UpdateUserRequest $request)
  {
    $manipulatedUser = User::find(['id' => $request->route('user')])->first();
    $manipulatedUser->fill($request->validated());

    if ($manipulatedUser->isDirty('email')) {
      $manipulatedUser->email_verified_at = null;
    }

    $manipulatedUser->save();

    return redirect()->route('users.show', ['user' => $manipulatedUser->id])->with("Successfully updated.");
  }

  public function show(Request $request, User $user): View
  {
    $formatForAdminLTE = function ($rawEloquentCollection) {
      $data = [];
      foreach ($rawEloquentCollection as $item) {
        $data[$item['id']] = $item['name'];
      }

      return $data;
    };

    return view('users.usershow', [
      'user' => $user,
      'memberRoles' => $user->roles()->get()->pluck('name', 'id')->toArray(),
      'memberGroups' => $user->groups()->get()->pluck('name', 'id')->toArray(),
    ]);
  }

  public function destroy(User $user)
  {
    $user->delete();

    return redirect('/users');
  }
}
