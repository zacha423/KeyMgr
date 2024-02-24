<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Key extends Model
{
  use HasFactory;
  protected $fillable = [
    'keyLevel',
    'keySystem',
  ];
  
  protected function getSerial(): string
  {
    return $this->keyLevel .  ' ' . $this->keySystem;
  }
  public function type(): BelongsTo
  {
    return $this->belongsTo(KeyType::class);
  }
}


