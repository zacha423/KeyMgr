<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Building;

class Room extends Model
{
  use HasFactory;

  protected $fillable = [
    'number',
    'description',
  ];

  /**
   * Summary: Get the building a room is in.
   * 
   * @see App\Models\Building
   */
  public function building (): HasOne 
  {
    return $this->hasOne(Building::class);
  }
  /**
   * Summary: Get the doors a room has.
   * 
   * @see App\Models\Door
   */
  public function doors (): HasMany
  {
    return $this->hasMany (Door::class);
  }

  public function keyStorages(): HasMany
  {
    return $this->hasMany (KeyStorage::class);
  }
}
