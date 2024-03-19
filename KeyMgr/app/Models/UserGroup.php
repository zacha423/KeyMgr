<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * Purpose: Represent real life divisions of organizations. 
 *          (e.g. Department, Employee/Student)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserGroup extends Model
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
   * Not mass assignable attributes
   * 
   * @var array<int, mixed>
   */
  protected $guarded = [
    'parent_id_fk',
  ];

  /**
   * Get any groups that have the current group as a parent.
   */
  public function children(): HasMany
  {
    return $this->hasMany(UserGroup::class, 'parent_id_fk', 'id');
  }

  /**
   * Get the parent group of the current group.
   */
  public function parent(): BelongsTo
  {
    return $this->belongsTo(UserGroup::class, 'parent_id_fk');
  }

  /**
   * Get all users in the group.
   */
  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }
}
