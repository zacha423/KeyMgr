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
    Schema::create('buildings', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->foreignId('campus_id')->constrained();
      $table->foreignId('address_id')->constrained();
      $table->timestamps();
      $table->unique (['name', 'campus_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('buildings');
  }
};
