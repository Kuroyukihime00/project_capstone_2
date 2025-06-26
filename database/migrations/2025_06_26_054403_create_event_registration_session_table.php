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
        Schema::create('event_registration_session', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_registration_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_session_id')->constrained()->onDelete('cascade');
            $table->boolean('attended')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registration_session');
    }
};
