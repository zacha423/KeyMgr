<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
  public function building (): BelongsTo 
  {
    return $this->belongsTo(Building::class);
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

  /**
   * Get available keys, do run the query.
   */
  public function availableKeys() {
    return $this->availableKeys_query()->get();
  }

  /**
   * Get available keys, do not run the query.
   */
  public function availableKeys_query() {
    return Key::whereHas('openableLocks.door.room', function ($query) { 
      $query->where(['number' => $this->number, 'building_id' => $this->building_id]); 
    })->where([
      'key_status_id' => KeyStatus::where([
        'name' => config('constants.keys.statuses.unassigned.name')
      ])->first()->id,
    ]);
  }
}
