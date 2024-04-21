<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KeyAuthStatus extends Model
{
  protected $fillable = [
    'name',
    'description',
  ];

  public function authorizations(): HasMany
  {
    return $this->hasMany(KeyAuthorization::class);
  }
}
