<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Door extends Model
{
  use HasFactory;

  protected $fillable = [
    'doorDescription',
    'hardwareDescription',
  ];

  public function room (): HasOne
  {
    return $this->hasOne(Room::class);
  }
}
