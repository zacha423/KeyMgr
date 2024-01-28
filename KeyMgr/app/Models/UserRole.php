<?php
//**************************************************************************************************
// Filename: UserRole.php
// Author:   Zachary Abela-Gale
// Date:     2024/01/24
// Purpose:  Implements a database table to create software roles
//**************************************************************************************************
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
  use HasFactory;
  public $timestamps = false;

  /**
   * Mass assignable attributes
   * 
   * @var array<int, string>
   */
  protected $fillable = [
    'name'
  ];
}
