<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;

class TestAccountsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $domain = '@keymgr.com';
    $password = 'Abcd123!';
    // fN, lN, uN, email, password
    $accounts = [
      [
        'firstName' => 'Key', 
        'lastName' => 'Holder', 
        'username' => 'keyholder', 
        'email' => 'holder' . $domain, 
        'password' => $password, 
        'role' => 'Key Holder'
      ],
      [
        'firstName' => 'Key',
        'lastName' => 'Requestor',
        'username' => 'keyrequestor',
        'email' => 'requestor' . $domain,
        'password' => $password,
        'role' => 'Key Requestor',
      ],
      [
        'firstName' => 'Key',
        'lastName' => 'Authority',
        'username' => 'keyauthority',
        'email' => 'authority' . $domain,
        'password' => $password,
        'role' => 'Key Authority',
      ],
      [
        'firstName' => 'Key',
        'lastName' => 'Issuer',
        'username' => 'keyissuer',
        'email' => 'issuer' . $domain,
        'password' => $password,
        'role' => 'Key Issuer',
      ],
      [
        'firstName' => 'Locksmith',
        'lastName' => '',
        'username' => 'locksmith',
        'email' => 'locksmith' . $domain,
        'password' => $password,
        'role' => 'Locksmith',
      ],
      [
        'firstName' => 'Admin',
        'lastName' => '',
        'username' => 'admin',
        'email' => 'admin' . $domain,
        'password' => $password,
        'role' => 'Admin',
      ]
    ];

    foreach ($accounts as $account)
    {
      $user = User::createOrFirst($account);
      $user->roles()->attach(UserRole::where(['name' => $account['role']]));
    }
  }
}
