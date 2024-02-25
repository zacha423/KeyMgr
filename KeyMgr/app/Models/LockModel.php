<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LockModel extends Model
{
  protected $fillable = [
    'MACS',
    'name',
  ];

  public function manufacturer (): BelongsTo
  {
    return $this->belongsTo (Manufacturer::class);
  }
}
