<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MessageTemplate extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'message',
  ];

  public function lockMaintenance(): BelongsToMany
  {
    return $this->belongsToMany(Lock::class);
  }
}
