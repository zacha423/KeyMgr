<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locks', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('numPins');
            $table->string('upperPinLengths');
            $table->string('masterPinLengths');
            $table->string('lowerPinLengths');
            $table->dateTimeTz('installDate');
            $table->foreignId('keyway_id')->constrained();
            $table->foreignId('master_key_system_id')->nullable()->constrained();
            $table->foreignId('lock_model_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locks');
    }
};