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
    Schema::table('key_key_authorization', function (Blueprint $table) {
      $table->dropColumn('replacement_cost');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('key_key_authorization', function (Blueprint $table) {
      $table->unsignedDouble('replacement_cost', 10, 4)->default(0.0);
    });
  }
};
