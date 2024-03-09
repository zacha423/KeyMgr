<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterKeySystem extends Model
{
  protected $fillable = [
    'name',
  ];

  public function parent(): BelongsTo
  {
    return $this->belongsTo(MasterKeySystem::class);
  }

  public function children(): HasMany
  {
    return $this->hasMany(MasterKeySystem::class);
  }
}
