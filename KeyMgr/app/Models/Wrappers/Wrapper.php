<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu
 */
namespace App\Models\Wrappers;

class Wrapper {
  /**
   * Similar to Laravel's env() helper.
   * 
   * @param array<string, mixed> $array - the data array to search
   * @param string $key                 - the key to search for in $array
   * @param mixed $default              - the fallback value if $key is not found
   * 
   * @return mixed - the value in the array if found, or the fallback value
   */
  protected static function arrayOrDefault ($array, $key, $default): mixed
  {
    if (array_key_exists ($key, $array))
    {
      return $array[$key];
    }

    return $default;
  }
}