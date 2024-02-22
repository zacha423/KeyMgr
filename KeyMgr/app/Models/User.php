<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * @todo Add relationships for UserGroup and UserRole.
 */
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
  public function getFullname () : string
  {
    return $this->firstName .' '. $this->lastName;
  }

  public function roles() : BelongsToMany
  {
    return $this->belongsToMany(UserRole::class);
  }

  public function groups(): BelongsToMany
  {
    return $this->belongsToMany(UserGroup::class);
  }


}
