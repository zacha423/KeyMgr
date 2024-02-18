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

class AddressWrapper {
  /**
   * Similar to Laravel's env() helper.
   * 
   * @param array<string, mixed> $array - the data array to search
   * @param string $key                 - the key to search for in $array
   * @param mixed $default              - the fallback value if $key is not 
   * 
   * @return mixed - the value in the array if found or the fallback value
   */
  protected static function arrayorDefault ($array, $key, $default): mixed
  {
    if (array_key_exists ($key, $array))
    {
      return $array[$key];
    }
    return $default;
  }
  /**
   * Find or make a country.
   * 
   * @param string $name - the name of the 
   * 
   * @return Country - a country with the provided name
   */
  protected static function country (string $name): Country
  {
    return Country::firstOrCreate (['name' => $name]);
  }
  /**
   * Find or make a state in a specific country.
   * 
   * @param string $name     - the name of the state
   * @param Country $country - the country the state is in
   * 
   * @return State - a state with in the provided country with $name.
   */
  protected static function state (string $name, Country $country): State
  {
    return $country->states()->save(State::firstOrNew(['name' => $name, 'country_id' => $country->id]));
  }
  /**
   * Find or make a new city in a specific state.
   * 
   * @param string $name - the name of the city
   * @param State $state - the state the city is in
   * 
   * @return City - the City with $name in the proivded state
   */
  protected static function city (string $name, State $state): City
  {
    return $state->cities()->save(City::firstOrNew(['name' => $name, 'state_id' => $state->id]));
  }
  /**
   * Find or make a new Postal Code
   * 
   * @param string $code - the postal code
   * 
   * @return PostalCode - the postal code
   */
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
    $state = AddressWrapper::state ($addressData['state'], $country);
    $city = AddressWrapper::city ($addressData['city'], $state);
    $postalCode = AddressWrapper::postal ($addressData['postalCode']);

    $address = Address::firstOrNew(['streetAddress'=>$addressData['streetAddress']]);
    $address->postal_code_id = $postalCode->id;
    $address->city_id = $city->id;
    $address->save();

    return $address;
  }

  /**
   *  @param array<string, mixed> $updatedDate - validated form data to build an address
   *    expected keys: 
   *      country, 
   *      state, 
   *      city,  
   *      postalCode, 
   *      streetAddress
   * 
   *  @todo This can likely be optimized. Once time is less of a constraint consider redeveloping from the reverse angle.
   */
  public static function merge ($updatedDate, Address $Address): Address
  {
    $country = AddressWrapper::country (AddressWrapper::arrayorDefault ($updatedDate, 'country', Country::where ([
      'id' => State::where (['id' => $Address->city()->first()->state_id])->first()->country_id])->first()->name));
    $state = AddressWrapper::state (AddressWrapper::arrayorDefault($updatedDate, 'state', State::where ([
      'id' => $Address->city()->first()->state_id])->first()->name), $country);
    $city = AddressWrapper::city (AddressWrapper::arrayorDefault(
      $updatedDate, 'city', $Address->city()->first()->name), $state);
    $postal = AddressWrapper::postal (AddressWrapper::arrayorDefault(
      $updatedDate, 'postalCode', $Address->zipcode()->getRelated()->first()->code));
    
    $mergedAddress = $Address;

    // Check if $Address is used by a Building and Campus, and replicate to prevent data loss.
    if (Building::where (['address_id' => $Address->id])->count() + 
        Campus::where (['address_id' => $Address->id])->count() > 1)
    {
      $mergedAddress = $Address->replicate ();
    }

    $mergedAddress->city_id = $city->id;
    $mergedAddress->postal_code_id = $postal->id;
    $mergedAddress->streetAddress = 
      AddressWrapper::arrayorDefault ($updatedDate, 'streetAddress', $mergedAddress->streetAddress);
    $mergedAddress->save();
    
    return $mergedAddress;
    
  }
}