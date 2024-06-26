<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Policies;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Auth\Access\Response;

class UserGroupPolicy
{
  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool
  {
    
    // $allowedRoles = UserRole::whereIn('name', [$a['']])
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, UserGroup $userGroup): bool
  {
    //
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool
  {
    return $user->isElevated();
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, UserGroup $userGroup): bool
  {
    return $user->isElevated();
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, UserGroup $userGroup): bool
  {
    return $user->isElevated();
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, UserGroup $userGroup): bool
  {
    return $user->isElevated();
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, UserGroup $userGroup): bool
  {
    return $user->isElevated();
  }
}
