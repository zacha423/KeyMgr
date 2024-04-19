<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('locks', function (Blueprint $table) {
      $table->foreignId('door_id')->nullable()->constrained()->nullOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('lock_door');
  }
};
