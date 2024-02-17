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
    
    // $address = $city->addresses()->save(
    //   $postalCode->addresses()->save(
    //     Address::firstOrNew(['streetAddress' => $addressData['streetAddress']])
    //   )
    // );

    $addy = Address::firstOrNew(['streetAddress'=>$addressData['streetAddress']]);
    echo 'a';
    $addy->postal_code_id = $postalCode->id;
    echo 'b';
    // $addy->city()->save ($city)->save();
    $addy->city_id = $city->id;
    echo 'c';
    $addy->save();
    echo 'd';
    // $state = State::firstOrCreate ([
    //   'name' => $addressData['state'], 
    //   'country_id' => $country->id,
    // ]);

    // $t = Country::where('name', '=', $addressData['country'])->firstOr(function)
    // $city = City::firstOrCreate ([
    //   'name' => $addressData['city'],
    //   'state_id' => $state->id,
    // ]);
    // $postalCode = PostalCode::firstOrCreate ([
    //   'code' => $addressData['postalCode'],
    // ]);

    return $addy;
    // return Address::find(1);
    // return Address::firstOrCreate ([
    //   'streetAddress' => $addressData['streetAddress'],
    //   'postal_code_id' => $postalCode->id,
    //   'city_id' => $city->id,
    // ]);
  }
}