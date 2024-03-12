<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyAuthStatus extends Model
{
  protected $fillable = [
    'name',
    'description',
  ];
}
