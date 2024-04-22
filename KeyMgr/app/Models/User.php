<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Resources\RoleResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'firstName',
    'lastName',
    'username',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * @return string Returns the fullname of the user.
   */
  public function getFullname(): string
  {
    return $this->firstName . ' ' . $this->lastName;
  }

  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(UserRole::class);
  }

  public function groups(): BelongsToMany
  {
    return $this->belongsToMany(UserGroup::class);
  }

  public function authorizations(): HasMany
  {
    return $this->hasMany(KeyAuthorization::class, 'key_holder_user_id');
  }

  /**
   * Helper function to add a user to a group.
   */
  public function addToGroup(UserGroup $userGroup): void
  {
    $this->groups()->attach($userGroup);
  }

  /**
   * Helper function to remove a user from a group.
   */
  public function removeFromGroup(UserGroup $userGroup): void
  {
    $this->groups()->detach(($userGroup));
  }

  /**
   * Helper function to add a role to a user.
   */
  public function assignRole(UserRole $userRole): void
  {
    $this->roles()->attach($userRole);
  }

  /**
   * Helper function to remove a role from a user.
   */
  public function unassignRole(UserRole $userRole): void
  {
    $this->roles()->detach($userRole);
  }

  public function isElevated()
  {
    $configRoles = config('constants.roles');
    $elevatedRoles = (UserRole::whereIn('name', [
      $configRoles['issuer'],
      $configRoles['locksmith'],
      $configRoles['admin'],
    ])->get());

    foreach ($elevatedRoles as $role) {
      if ($this->roles->contains($role)) {
        return true;
      }
    }
    return false;
  }

  public static function getIssuers()
  {
    return User::whereHas('roles', function ($query) {
      $query->where([
        'name' => config('constants.roles.issuer')
      ]); 
    })->get();
  }

  public static function getHolders() {
    return User::whereHas('roles', function ($query) {
      $query->where([
        'name' => config('constants.roles.holder')
      ]);
    });
  }

  public static function getRequestors() {
    return User::whereHas('roles', function ($query) {
      $query->where([
        'name' => config('constants.roles.requestor'),
      ]);
    });
  }

  public function adminlte_profile_url() { return '/profile';}
}
