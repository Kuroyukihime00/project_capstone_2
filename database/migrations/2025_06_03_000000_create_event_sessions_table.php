
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('event_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('nama_sesi');
            $table->date('tanggal_sesi');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->timestamps();
            $table->string('speaker')->nullable();
            $table->decimal('price', 10, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_sessions');
    }
};
