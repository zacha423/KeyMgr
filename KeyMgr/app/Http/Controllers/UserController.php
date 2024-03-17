<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * Purpose: This controller can be used for managing user management. 
 * Basic login/authentication should be done through Breeze's controllers.
 */
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroup;
use App\Models\Wrappers\RBACWrapper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

  public function index()
  {
    $data = [];

    foreach (User::all() as $user) {
      $btnEdit = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
        </button>';
      $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" title="Delete" data-user-id="' . $user->id . '">
        <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';
      $btnDetails = '<a href="' . route('users.show', $user->id) . '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
              <i class="fa fa-lg fa-fw fa-eye"></i>
          </button>';


      array_push($data, [$user->id, $user->firstName, $user->lastName, $user->email, '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>']);
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

  public function show(User $user)
  {
    return redirect('/users'); 
  }

  public function destroy(User $user)
  {
    $user->delete();

    return redirect('/users'); 
  }

}
