<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Provider\en_US\Address as FakeAddress;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\PostalCode;
use SebastianBergmann\Type\VoidType;

class AddressSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  private function bulk(): void
  {
    //seed each type and select randomly
  }
  public function run(): void
  {
    $USA = Country::firstOrCreate([
      'ISOCode3' => 'USA',
      'name' => 'United States',
    ]);
    $Oregon = State::firstOrCreate([
      'abbreviation' => 'OR',
      'name' => 'Oregon',
      'country_id' => $USA->id,
    ]);
    $Cornelius = City::firstOrCreate([
      'name' => 'Cornelius',
      'state_id' => $Oregon->id,
    ]);
    $Hillsboro = City::firstOrCreate([
      'name' => 'Hillsboro',
      'state_id' => $Oregon->id,
    ]);
    $ForestGrove = City::firstOrCreate([
      'name' => 'Forest Grove',
      'state_id' => $Oregon->id,
    ]);
    
    //create $addresses and foreach the array, or implement buildAddresses
    $this->buildAddress([
      'address' => '1370 N Adair St',
      'city' => 'Cornelius',
      'postal' => 97113
    ]);

    $this->bulk();
  }

  /**
   * @return Address - the (newly created) address
   */
  protected function buildAddress($address): Address
  {
    $city = City::where(['name' => $address['city']])->first();
    $postal = PostalCode::firstOrCreate(['code' => $address['postal']]);
    return Address::firstOrCreate([
      'streetAddress' => $address['address'], 
      'city_id' => $city->id, 
      'postal_code_id' => $postal->id
    ]);
  }
}
