<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Door extends Model
{
  use HasFactory;

  protected $fillable = [
    'description',
    'hardwareDescription',
  ];

  public function room (): HasOne
  {
    return $this->hasOne(Room::class);
  }
}
