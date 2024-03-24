<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * @author Liam Henry <henr5288@pacificu.edu>
 * 
 * Purpose: This controller can be used for managing user management. 
 * Basic login/authentication should be done through Laravel Breeze's controllers.
 */
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserRole;
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
      $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-user-id="'
        . $user->id . '">
          <i class="fa fa-lg fa-fw fa-trash"></i>
          </button>';
      $btnDetails = '<a href="' . route('users.show', $user['id'])
        . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
            </button>';

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

    $groups = [];
    foreach (GroupResource::collection(UserGroup::all())->toArray($request) as $group) {
      $groups[$group['id']] = $group['name'];
    }

    $roles = [];
    foreach (RoleResource::collection(UserRole::all())->toArray($request) as $role) {
      $roles[$role['id']] = $role['name'];
    }

    return view('users.userlist', [
      'users' => $data,
      'groupOptions' => $groups,
      'roleOptions' => $roles,
      'selectedGroups' => $groupIDs,
      'selectedRoles' => $roleIDs,
    ]);
  }

  /**
   * Add a group membership to a set of users.
   * 
   * @todo Determine appropriate return type
   */
  public function assignUsersToGroup(Request $request): RedirectResponse
  {
    // RBACWrapper::assignUsersToGroup();

    return redirect('/');
  }
  /**
   * Remove a group membership from a set of users
   * 
   * @todo Determine appropriate return type
   */
  public function unassignUsersFromGroup(Request $request): RedirectResponse
  {
    // RBACWrapper::unassignUsersFromGroup();

    return redirect('/');
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

  public function edit(User $user)
  {
    return redirect('/users');
  }

  public function update(UpdateUserRequest $request)
  {
    // $request->user()->fill($request->validated());
    $luser = User::find(['id' => $request->route('user')])->first();
    $luser->fill($request->validated());

    if ($luser->isDirty('email')) {
        $luser->email_verified_at = null;
    }

    $luser->save();

    return redirect()->route('users.show', ['user' => $luser->id])->with("Successfully updated.");
  }
  
  public function show(Request $request, User $user): View
  {
    return view('users.usershow', [
      'user' => $user,
    ]);
  }

  public function destroy(User $user)
  {
    $user->delete();

    return redirect('/users');
  }
}
