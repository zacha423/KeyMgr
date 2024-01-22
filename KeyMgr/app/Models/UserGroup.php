<?php
//**************************************************************************************************
// Filename: UserGroup.php
// Author:   Zachary Abela-Gale
// Date:     2024/01/20
// Purpose:  A UserGroup is used to representing real life divisions of organizations. 
//           These divisions could be departments, or even types of employees. (CAS vs CoB, Student vs. Staff, etc.)
//**************************************************************************************************
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserGroup extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * Mass assignable attributes
     * 
     * @var array<int, string>
     */
    protected $fillable = [
      'name'
    ];

    /**
     * Not mass assignable attributes
     * 
     * @var array<int, mixed>
     */
    protected $guarded = [
      'parent_id_fk',
    ];

    /**
     * Get any groups that have the current group as a parent.
     */
    public function children ()
    {
      return $this->hasMany(UserGroup::class,'parent_id_fk','id');
    }

    /**
     * Get the parent group of the current group.
     */
    public function parent ()
    {
      return $this->belongsTo(UserGroup::class, 'parent_id_fk');
    }
}
