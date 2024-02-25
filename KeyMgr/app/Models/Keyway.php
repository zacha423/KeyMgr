<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keyway extends Model
{
  protected $fillable = [
    'name',
  ];

  public function keys(): HasMany
  {
    return $this->hasMany(Key::class);
  }

  public function locks(): HasMany
  {
    return $this->hasMany(Lock::class);
  }
}
