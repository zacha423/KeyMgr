<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * @deprecated TBD - may not be needed, but not deleting until confirmed
 */

namespace App\Models\Wrappers;

use App\Models\User;
use App\Models\UserGroup;

class RBACWrapper extends Wrapper
{
  /**
   * Aassign 1 or more users to a group
   * 
   * @param array<User> $users - all users to modify
   * @param UserGroup   $group - the group to add each user into
   */
  protected static function assignUsersToGroup($users, $group): void
  {
    foreach ($users as $user) {
      if (!$user->groups->contains($group)) {
        $user->assignToGroup($group);
      }
    }
  }
  /**
   * Take 1 or more users and unassign them from a group.
   * 
   * @param array<User> $users - all users to modify
   * @param UserGroup   $group - the group to remove from each user
   */
  protected static function unassignUsersFromGroup($users, $group): void
  {
    foreach ($users as $user) {
      if ($user->groups->contains($group)) {
        $user->unassignFromGroup($group);
      }
    }


  }
}