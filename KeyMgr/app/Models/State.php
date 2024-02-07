<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'abbreviation',
  ];

  public function country(): BelongsTo 
  {
    return $this->belongsTo(Country::class);
  }
}
