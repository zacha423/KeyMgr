<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterKeySysstem extends Model
{
  protected $fillable = [
    'name',
  ];

  public function parent(): BelongsTo
  {
    return $this->belongsTo(MasterKeySysstem::class);
  }

  public function children(): HasMany
  {
    return $this->hasMany(MasterKeySysstem::class);
  }
}
