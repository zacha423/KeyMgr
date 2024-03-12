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
    Schema::create('key_key_authorization', function (Blueprint $table) {
      $table->id();
      $table->foreignId('key_authorization_id');
      $table->foreignId('key_id');
      $table->date('due_date')->nullable();
      $table->unsignedDouble('replacement_cost', 10, 4)->default(0.0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('key_key_authorization');
  }
};
