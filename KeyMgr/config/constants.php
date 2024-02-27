<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */

return [
  'keys' => [
    'statuses' => [
      // Add additional key statuses here
      'unassigned' => [
        'name' => 'Unassigned',
        'description' => 'The key is not assigned to a person.'
      ],
      'assigned' => [
        'name' => 'Assigned',
        'description' => 'The key is assigned to a person.'
      ],
      'lost' => [
        'name' => 'Lost',
        'description' => 'The key has been lost.',
      ],
      'broken' => [
        'name' => 'Broken',
        'description' => 'The key is physically broken.',
      ],
      'requested' => [
        'name' => 'Requested',
        'description' => 'The key is needed to fulfill a Key Authorization request.',
      ],
    ],
  ],
  'locks' => [],
];