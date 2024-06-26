<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Door extends Model
{
  use HasFactory;

  protected $fillable = [
    'description',
    'hardwareDescription',
  ];

  public function room (): BelongsTo
  {
    return $this->belongsTo(Room::class);
  }

  public function locks(): HasMany
  {
    return $this->hasMany(Lock::class);
  }
}
