<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StorageHook extends Model
{
  protected $fillable = [
    'rowNum',
    'colNum',
  ];

  public function keys(): HasMany
  {
    return $this->hasMany(Key::class);
  }

  public function keyStorage(): BelongsTo
  {
    return $this->belongsTo(KeyStorage::class);
  }
}
