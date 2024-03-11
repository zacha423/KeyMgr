<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\KeyAuthStatus;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('key_auth_statuses', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('description');
      $table->timestamps();
    });

    $this->seed();
  }

  /**
   * Insert the Key Authorization statuses into the database.
   */
  protected function seed(): void
  {
    foreach(config('constants.keyauthreq.statuses') as $status)
    {
      KeyAuthStatus::create ($status);
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('key_auth_statuses');
  }
};
