<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeyStorage extends Model
{
  protected $fillable = [
    'name',
    'numRows',
    'numCols',
  ];

  public function room (): BelongsTo
  {
    return $this->belongsTo(Room::class);
  }
}
