<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
  ];

  public function state(): BelongsTo
  {
    return $this->belongsTo(State::class);
  }

  public function addresses(): HasMany
  {
    return $this->hasMany(Address::class);
  }
}
