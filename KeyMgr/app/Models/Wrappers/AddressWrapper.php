<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models\Wrappers;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Address;
use App\Models\PostalCode;

class AddressWrapper {
  /**
   * @param array<string, mixed> $addressData - validated form data to build an address
   *    expected keys: country, state, city,  postalCode, streetAddress
   * @return Address - the existing or newly created address.
   */
  public static function build ($addressData): Address
  {
    $country = Country::firstOrCreate ([
      'name' => $addressData['country'],
    ]);
    $state = $country->states()->save(State::firstOrNew(['name' => $addressData['state']]));
    $city = $state->cities()->save(City::firstOrNew(['name' => $addressData['city']])); 
    $postalCode = PostalCode::firstOrCreate ([
      'code' => $addressData['postalCode'],
    ]);

    $address = Address::firstOrNew(['streetAddress'=>$addressData['streetAddress']]);
    $address->postal_code_id = $postalCode->id;
    $address->city_id = $city->id;
    $address->save();

    return $address;
  }
}