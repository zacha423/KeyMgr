<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\KeyStatus;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('key_statuses', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('description');
      $table->timestamps();
    });

    $this->seed();
  }

  /**
   * Insert the Key Statuses into the database
   */
  protected function seed(): void
  {
    foreach (config('constants.keys.statuses') as $status)
    {
      KeyStatus::create ($status);
    }
    // KeyStatus::create (config('constants.keys.statuses.unassigned'));
    // KeyStatus::create (config('constants.keys.statuses.assigned'));
    // KeyStatus::create (config('constants.keys.statuses.lost'));
    // KeyStatus::create (config('constants.keys.statuses.broken'));
    // KeyStatus::create (config('constants.keys.statuses.requested'));
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('key_statuses');
  }
};
