<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KeyAuthorization extends Model
{
  use HasFactory;

  protected $fillable = [];

  public function keyHolder (): BelongsTo
  {
    return $this->belongsTo(User::class, 'key_holder_user_id', 'id');
  }

  public function keyRequestor (): BelongsTo
  {
    return $this->belongsTo(User::class, 'requestor_user_id', 'id');
  }

  public function keyHolderContacts (): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  public function rooms (): BelongsToMany
  {
    return $this->belongsToMany (Room::class, 'key_authorization_room', 'key_authorization_id', 'room_id');
  }

  public function issuedKeys(): BelongsToMany
  {
    return $this->belongsToMany(Key::class)->withPivot('due_date');
  }
  public function scopeAuthorizationStatus($query, $statusName)
  {
      return $query->whereHas('status', function ($q) use ($statusName) {
          $q->where('name', $statusName);
      });
  }
}
