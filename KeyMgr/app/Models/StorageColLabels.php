<?php
/**
 * @author Zachary Abela-Gasle <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StorageColLabels extends Model
{
  protected $fillable = [
    'colNumber',
    'label',
  ];

  public function keyStorage(): BelongsTo
  {
    return $this->belongsTo (KeyStorage::class);
  }
}
