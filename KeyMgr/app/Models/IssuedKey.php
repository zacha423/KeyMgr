<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * This acts as an aggregate of the Key Authorization <-> Key relationship
 */
class IssuedKey extends Model
{
  use HasFactory;
  protected $table = 'key_key_authorization';
  protected $fillable = [
    'due_date',
    'replacement_cost',
  ];
  
  public function key(): BelongsTo
  {
    return $this->belongsTo(Key::class);
  }

  public function authorization(): BelongsTo
  {
    return $this->belongsTo(KeyAuthorization::class);
  }

  public function messages(): BelongsToMany
  {
    return $this->belongsToMany(MessageTemplate::class, 'issued_key_messages', 'issued_key_id', 'message_template_id');
  }

}