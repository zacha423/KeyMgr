<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 * 
 * Inserts the default roles used by KeyMgr.
 */
use Illuminate\Database\Migrations\Migration;
use App\Models\UserRole;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    UserRole::factory()->createMany([
      ['name' => 'Key Holder'],
      ['name' => 'Key Requestor'],
      ['name' => 'Key Authority'],
      ['name' => 'Key Issuer'],
      ['name' => 'Locksmith'],
      ['name' => 'Admin'],
    ]);
  }


};
