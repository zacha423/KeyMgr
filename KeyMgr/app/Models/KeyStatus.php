<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KeyStatus extends Model
{
  protected $fillable = [
    'name',
    'description',
  ];

  public function keys(): HasMany
  {
    return $this->hasMany (Key::class);
  }
}
