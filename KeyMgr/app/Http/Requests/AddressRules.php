<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu
 * @todo Make this a proper rule class to fit in the framework
 */
namespace App\Http\Requests;
class AddressRules {
  /**
   * Validation rules for creating a new address
   */
  public static function createRules(): array
  {
    $stringVal = ['required','string','max:255'];

    return [
      'country' => $stringVal,
      'state' => $stringVal,
      'city' => $stringVal,
      'streetAddress' => $stringVal,
      'postalCode' => $stringVal,
    ];
  }
  /**
   * Validation rules for updating an existing address
   */
  public static function updateRules(): array
  {
    $stringVal = ['string', 'max:255'];

    return [
      'country' => $stringVal,
      'state' => $stringVal,
      'city' => $stringVal,
      'streetAddress' => $stringVal,
      'postalCode' => $stringVal,
    ];
  }
}