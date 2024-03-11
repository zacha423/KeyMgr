<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KeyAuthorization extends Model
{
  use HasFactory;

  protected $fillable = [
    'agreement',
  ];

  public function keyHolder (): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function keyRequestor (): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function keyHolderContacts (): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  public function rooms (): BelongsToMany
  {
    return $this->belongsToMany (Room::class);
  }

  public function issuedKeys(): BelongsToMany
  {
    return $this->belongsToMany(Key::class);//, 'key_key_authorization', 'key_authorization_id', 'key_id');
  }
}
