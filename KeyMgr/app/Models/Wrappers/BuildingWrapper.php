<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models\Wrappers;

class BuildingWrapper extends Wrapper
{
  public static function loadRelationships(): array
  {
    return [
      'address' => [
        'city' => [
          'state' => [
            'country'
          ],
        ],
        'zipcode',
      ],
      'campus', // => [
        // 'address' => [
        //   'city' => [
        //     'state' => [
        //       'country'
        //     ],
        //   ],
        //   'zipcode',
        // ],
      // ],
      'rooms',
    ];
  }
}