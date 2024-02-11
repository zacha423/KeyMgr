<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Campus;

class Building extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
  ];
  
  public function address (): HasOne
  {
    return $this->hasOne(Address::class);
  }

  public function campus(): HasOne
  {
    return $this->hasOne(Campus::class);
  }
}
