<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
use Illuminate\Database\Migrations\Migration;
use App\Models\UserGroup;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    UserGroup::create(['name' => config('constants.groups.default')]);
  }
};
