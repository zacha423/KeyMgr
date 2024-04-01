<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models\Wrappers;

class LockWrapper extends Wrapper
{
  public static function loadRelationships(): array
  {
    return array_merge([
      'keyway',
      'lockModel' => LockModelWrapper::loadRelationships()
    ]);
  }
}