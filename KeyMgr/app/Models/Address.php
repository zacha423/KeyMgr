<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
  use HasFactory;

  protected $fillable = [
    'streetAddress',
  ];

  public function zipcode(): BelongsTo
  {
    return $this->belongsTo(PostalCode::class, 'postal_code_id', 'id');
  }
  public function city(): BelongsTo
  {
    return $this->belongsTo(City::class);
  }

  public function building(): HasOne
  {
    return $this->hasOne(City::class);
  }

  public function campus(): HasOne
  {
    return $this->hasOne(Campus::class);
  }
}
