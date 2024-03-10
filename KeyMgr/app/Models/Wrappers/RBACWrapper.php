<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */

namespace App\Models\Wrappers;

use App\Models\User;
use App\Models\UserGroup;

class RBACWrapper extends Wrapper
{
  /**
   * Aassign 1 or more users to 1 or more groups
   * 
   * @param array<User> $users       - all users to modify
   * @param array<UserGroup> $groups - the groups to add each user into
   */
  protected static function assignUsersToGroups($Users, $Groups): void
  {
    foreach ($Users as $user) {
      foreach ($Groups as $group) {
        $user->assignToGroup($group);
      }
    }
  }
  /**
   * Take 1 or more users and unassign them from 1 or more groups.
   * 
   * @param array<User> $Users       - all users to modify
   * @param array<UserGroup> $Groups - the groups to remove from each user
   */
  protected static function unassignUsersToGroups($Users, $Groups): void
  {
    foreach ($Users as $user) {
      foreach ($Groups as $group) {
        $user->unassignFromGroup ($group);
      }
    }


  }
}