<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models\Wrappers;

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