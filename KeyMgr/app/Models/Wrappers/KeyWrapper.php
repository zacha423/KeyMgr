<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models\Wrappers;
use App\Models\KeyStatus;
use App\Models\KeyType;
use App\Models\Keyway;

class KeyWrapper extends Wrapper
{
  public static function loadRelationships(): array
  {
    return [
      'status',
      'keyway',
      'type',
      'storage',
      'masterKeySystem',
    ];
  }
}