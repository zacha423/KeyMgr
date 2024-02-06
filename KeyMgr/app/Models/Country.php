<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   * 
   * @var array<int, string>
   */
  protected $fillable = [
    'ISOCode3',
    'name',
  ];
}
