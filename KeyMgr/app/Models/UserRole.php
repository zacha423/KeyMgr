<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * Purpose: Represent the roles we can assign to users.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserRole extends Model
{
  use HasFactory;
  public $timestamps = false;

  /**
   * Mass assignable attributes
   * 
   * @var array<int, string>
   */
  protected $fillable = [
    'name'
  ];

  /**
   * Get all Users with the role.
   */
  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  /**
   * Get groups the role is applied to
   */
  public function groups(): BelongsToMany
  {
    return $this->belongsToMany(UserGroup::class);
  }

  /**
   * Helper function to add a role to a group.
   */
  public function addToGroup(UserGroup $userGroup)
  {
    $this->groups()->attach($userGroup);
  }

  /**
   * Helper function to remove a role from a group.
   */
  public function removeFromGroup(UserGroup $userGroup)
  {
    $this->groups()->attach($userGroup);
  }
}
