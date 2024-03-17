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
    return view('users.userlist', [
      'users' => User::all()->toArray(),
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
}
