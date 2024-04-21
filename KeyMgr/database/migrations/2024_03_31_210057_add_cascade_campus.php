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
    Schema::table('buildings', function (Blueprint $table) {
      $table->dropForeign(['campus_id']);
      $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('buildings', function(Blueprint $table) {
      $table->dropForeign(['campus_id']);
      $table->foreign('campus_id')->references('id')->on('campuses');
    });
  }
};
