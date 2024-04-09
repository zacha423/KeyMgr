<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu
 */
namespace App\Models\Wrappers;

use App\Models\Wrappers\Wrapper;

class LockModelWrapper extends Wrapper
{
  public static function loadRelationships(): array
  {
    return [
      'manufacturer'
    ];
  }
}