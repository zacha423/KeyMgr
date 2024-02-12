<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostalCode extends Model
{
  use HasFactory;

  protected $fillable = [
    'code',
  ];

  public function addresses(): HasMany
  {
    return $this->hasMany(Address::class);
  }
}
