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
    Schema::create('key_authorizations', function (Blueprint $table) {
      $table->id();
      $table->string('agreement');
      $table->foreignId('key_holder_user_id')->on('users');
      $table->foreignId('requestor_user_id')->on('users');
      $table->foreignId('key_auth_status_id')->constrained();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('key_authorizations');
  }
};
