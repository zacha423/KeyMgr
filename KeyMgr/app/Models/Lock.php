<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lock extends Model
{
  use HasFactory;

  protected $fillable = [ 
    'numPins',
    'upperPinLengths',
    'masterPinLengths',
    'lowerPinLengths',
    'installDate',
  ];

  public function keyway(): BelongsTo
  {
    return $this->belongsTo(Keyway::class);
  }
  public function lockModel(): BelongsTo
  {
    return $this->belongsTo (LockModel::class);
  }
  public function masterKeySystem(): BelongsTo
  {
    return $this->belongsTo(MasterKeySystem::class);
  }
  public function messages(): BelongsToMany
  {
    return $this->belongsToMany(MessageTemplate::class);
  }
  public function keys(): BelongsToMany
  {
    return $this->belongsToMany(Key::class);
  }

  public function door(): BelongsTo
  {
    return $this->belongsTo(Door::class);
  }

  public function building(): Building
  {
    return $this->door()->first()->room()->first()->building()->first();
  }

  public function getRoom(): Room
  {
    return $this->door()->first()->room()->first();
  }
  
}
