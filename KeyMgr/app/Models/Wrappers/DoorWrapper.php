<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models\Wrappers;

use App\Models\Door;
use App\Models\Wrappers\Wrapper;

class DoorWrapper extends Wrapper
{
  public static function loadRelationships(): array
  {
    return [
      'room' => [
        'building'
      ],
    ];
  }
}