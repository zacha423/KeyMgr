<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StorageRowLabels extends Model
{
  protected $fillable = [
    'rowNumber',
    'label',
  ];

  public function keyStorage(): BelongsTo
  {
    return $this->belongsTo (KeyStorage::class);
  }
}
