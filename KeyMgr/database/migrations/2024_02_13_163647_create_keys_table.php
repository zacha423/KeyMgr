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
    Schema::create('keys', function (Blueprint $table) {
      $table->id();
      $table->string('keyLevel');
      $table->string('keySystem');
      $table->unsignedSmallInteger('copyNumber')->default(1);
      $table->string('bitting')->nullable();
      $table->string('blindCode')->nullable()->default(null);
      $table->string('mainAngles')->nullable()->default(null);
      $table->string('doubleAngles')->nullable()->default(null);
      $table->decimal('replacementCost', 9, 2)->default(0.0);
      $table->foreignId('key_status_id')->constrained();
      $table->foreignId('key_type_id')->nullable()->default(null)->constrained();
      $table->foreignId('master_key_system_id')->nullable()->default(null)->constrained();
      $table->foreignId('keyway_id')->constrained();
      $table->foreignId('storage_hook_id')->nullable()->default(null)->constrained();
      $table->unique(['keyLevel', 'keySystem', 'copyNumber']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('keys');
  }
};
