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
    'replacementCost',
  ];

  /**
   * Generates a serial number for the key based on the key level and key system
   */
  protected function getSerial(): string
  {
    return $this->keyLevel . ' ' . $this->keySystem;
  }
  public function type(): BelongsTo
  {
    return $this->belongsTo(KeyType::class, 'key_type_id', 'id');
  }
  public function status(): BelongsTo
  {
    return $this->belongsTo(KeyStatus::class, 'key_status_id', 'id');
  }
  public function storage(): BelongsTo
  {
    return $this->belongsTo(StorageHook::class, 'storage_hook_id', 'id');
  }
  public function keyway(): BelongsTo
  {
    return $this->belongsTo(Keyway::class);
  }
  public function masterKeySystem(): BelongsTo
  {
    return $this->belongsTo(MasterKeySystem::class, 'master_key_system_id', 'id');
  }
  public function openableLocks(): BelongsToMany
  {
    return $this->belongsToMany(Lock::class);
  }

  public function keyAuthorizationAgreements(): BelongsToMany
  {
    return $this->belongsToMany(KeyAuthorization::class);
  }

  public function room(): Room
  {
    return $this->openableLocks()->first()->door()->first()->room()->first();
  }

  public function building(): Building
  {
    return $this->room()->building()->first();
  }
}


