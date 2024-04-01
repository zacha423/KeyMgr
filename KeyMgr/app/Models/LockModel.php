<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LockModel extends Model
{
  use HasFactory;
  protected $fillable = [
    'MACS',
    'name',
  ];

  public function manufacturer (): BelongsTo
  {
    return $this->belongsTo (Manufacturer::class);
  }

  public function locks(): HasMany
  {
    return $this->hasMany(Lock::class);
  }
}
