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
    Schema::create('storage_col_labels', function (Blueprint $table) {
      $table->id();
      $table->unsignedSmallInteger('colNumber');
      $table->string('label');
      $table->foreignId('key_storage_id')->constrained();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('storage_col_labels');
  }
};
