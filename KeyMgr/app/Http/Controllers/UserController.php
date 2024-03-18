<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * @author Liam Henry <henr5288@pacificu.edu>
 * 
 * Purpose: This controller can be used for managing user management. 
 * Basic login/authentication should be done through Breeze's controllers.
 */
namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

  public function index()
  {
    $data = [];

    // $users = User::with('roles')->get();

    // foreach ($users as $user) {
    foreach (User::all() as $user3) {
      $user = (new UserResource($user3));
      $user4 = $user->toArray(new Request ());
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
        implode("\n", $user4['groups2']), 
        implode("\n",$user4['roles2']), 
        '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'
      ]);
    }
    return view('users.userlist', [
      'users' => $data,
      'usersJSON' => User::all()->toJson(),
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

  public function edit(User $user)
  {
    return redirect('/users'); 
  }

  /**
   * @todo Is this an admin show or a end user show? See app/Http/Controllers/ProfileController
   */
  public function show(Request $request): View
  {
    return view('users.usershow', [
      'user' => $request->user(),
     ]);
    // return redirect('/users'); 
  }

  public function destroy(User $user)
  {
    $user->delete();

    return redirect('/users'); 
  }
}
