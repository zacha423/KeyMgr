<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Building;

class Room extends Model
{
  use HasFactory;

  protected $fillable = [
    'number',
    'description',
  ];

  public function building (): HasOne 
  {
    return $this->hasOne(Building::class);
  }
}
