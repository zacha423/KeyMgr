<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Key extends Model
{
  use HasFactory;
  protected $fillable = [
    'keyLevel',
    'keySystem',
    'copyNumber',
    'bitting',
    'blindCode',
    'mainAngles',
    'doubleAngles',
    'replacementCost',
  ];
  
  /**
   * Generates a serial number for the key based on the key level and key system
   */
  protected function getSerial(): string
  {
    return $this->keyLevel .  ' ' . $this->keySystem;
  }
  public function type(): BelongsTo
  {
    return $this->belongsTo(KeyType::class);
  }
  public function status(): BelongsTo
  {
    return $this->belongsTo(KeyStatus::class);
  }
  public function storage(): BelongsTo
  {
    return $this->belongsTo(StorageHook::class);
  }
  public function keyway(): BelongsTo
  {
    return $this->belongsTo(Keyway::class);
  }
  public function masterKeySystem(): BelongsTo
  {
    return $this->belongsTo(MasterKeySystem::class);
  }
  public function openableLocks(): BelongsToMany
  {
    return $this->belongsToMany(Lock::class);
  }
}


