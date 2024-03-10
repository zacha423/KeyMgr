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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
  /**
   * Add a group membership to a set of users.
   * 
   * @param array<User> $users
   * @param UserGroup $group
   * 
   * @todo Determine appropriate return type
   */
  public function assignUsersToGroup($users, UserGroup $group): RedirectResponse
  {
    foreach ($users as $user) {
      if (!$user->groups->contains($group)) {
        $user->groups()->attach($group);
      }
    }

    return redirect('/');
  }
  /**
   * Remove a group membership from a set of users
   * 
   * @param array<User> $users
   * @param UserGroup $group
   * 
   * @todo Determine appropriate return type
   */
  public function unassignUsersFromGroup($users, UserGroup $group): RedirectResponse
  {
    foreach ($users as $user) {
      if ($user->groups->contains($group)) {
        $user->groups()->detach($group);
      }
    }

    return redirect('/')
  }
}
