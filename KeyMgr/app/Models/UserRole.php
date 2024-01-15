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

  // /**
  //  * The Primary key associated with the table. 
  //  * (String is the content of the variable, not the PK data type.)
  //  * 
  //  * @var string
  //  */
  // protected $primaryKey = 'RoleID';
  public $timestamps = false;
  // public $incrementing = true;
  // protected $table = 'KeyMgr.UserRole';

  /**
   * Mass assignable attributes
   * 
   * @var array<int, string>
   */
  protected $fillable = [
    'name'
  ];
}
