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
use App\Models\Building;
use App\Models\Campus;
use Database\Seeders\AddressSeeder;

class AddressWrapper {
  protected static function arrayorDefault ($array, $key, $default): mixed
  {
    // if (isset ($array, $key))
    if (array_key_exists ($key, $array))
    {
      // echo 'Array: '. $array->toJson;
      // echo 'Key: ' . $key;
      return $array[$key];
    }
    return $default;
  }
  protected static function country (string $name): Country
  {
    return Country::firstOrCreate (['name' => $name]);
  }
  protected static function state (string $name, Country $country): State
  {
    return $country->states()->save(State::firstOrNew(['name' => $name, 'country_id' => $country->id]));
  }
  protected static function city (string $name, State $state): City
  {
    return $state->cities()->save(City::firstOrNew(['name' => $name, 'state_id' => $state->id]));
  }
  protected static function postal (string $code): PostalCode
  {
    return PostalCode::firstOrCreate (['code' => $code]);
  }

  /**
   * @param array<string, mixed> $addressData - validated form data to build an address
   *    expected keys: 
   *      country, 
   *      state, 
   *      city,  
   *      postalCode, 
   *      streetAddress
   * @return Address - the existing or newly created address.
   */
  public static function build ($addressData): Address
  {
    $country = AddressWrapper::country ($addressData['country']);
    // $country = Country::firstOrCreate ([
    //   'name' => $addressData['country'],
    // ]);
    $state = AddressWrapper::state ($addressData['state'], $country);
    // $state = $country->states()->save(State::firstOrNew(['name' => $addressData['state']]));

    $city = AddressWrapper::city ($addressData['city'], $state);
    // $city = $state->cities()->save(City::firstOrNew(['name' => $addressData['city']])); 

    $postalCode = AddressWrapper::postal ($addressData['postalCode']);
    // $postalCode = PostalCode::firstOrCreate ([
    //   'code' => $addressData['postalCode'],
    // ]);

    $address = Address::firstOrNew(['streetAddress'=>$addressData['streetAddress']]);
    $address->postal_code_id = $postalCode->id;
    $address->city_id = $city->id;
    $address->save();

    return $address;
  }

  public static function merge ($newData, Address $Address): Address
  {
    $country = AddressWrapper::country (AddressWrapper::arrayorDefault ($newData, 'country', Country::where (['id' => State::where (['id' => $Address->city()->first()->state_id])->first()->country_id])->first()->name));
    $state = AddressWrapper::state (AddressWrapper::arrayorDefault($newData, 'state', State::where (['id' => $Address->city()->first()->state_id])->first()->name), $country);
    $city = AddressWrapper::city (AddressWrapper::arrayorDefault($newData, 'city', $Address->city()->first()->name), $state);
    $postal = AddressWrapper::postal (AddressWrapper::arrayorDefault($newData, 'postalCode', $Address->zipcode()->getRelated()->first()->code));
    
    $addy = $Address;
    // Check if $Address is used by a Building and Campus, and replicate to prevent data loss.
    if (Building::where (['address_id' => $Address->id])->count() + 
        Campus::where (['address_id' => $Address->id])->count() > 1)
    {
      $addy = $Address->replicate ();
    }

    $addy->city_id = $city->id;
    $addy->postal_code_id = $postal->id;
    $addy->streetAddress = AddressWrapper::arrayorDefault ($newData, 'streetAddress', $addy->streetAddress);
    $addy->save();
    
    return $addy;
    
  }
}