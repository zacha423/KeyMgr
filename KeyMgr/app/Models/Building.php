<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Campus;

class Building extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
  ];
  
  public function address (): BelongsTo
  {
    return $this->belongsTo(Address::class);
  }

  public function campus(): BelongsTo
  {
    return $this->belongsTo(Campus::class);
  }
  public function rooms(): HasMany
  {
    return $this->hasMany(Room::class);
  }
}
