<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
  use HasFactory;

  protected $fillable = [
    'streetAddress',
  ];

  public function zipcode(): BelongsTo
  {
    return $this->belongsTo(PostalCode::class);
  }
  public function city(): BelongsTo
  {
    return $this->belongsTo(City::class);
  }
}
