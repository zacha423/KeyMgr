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
        Schema::create('lock_message_template', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lock_id');
            $table->foreignId('message_template_id');
            $table->date ('maintenanceDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lock_message_template');
    }
};
