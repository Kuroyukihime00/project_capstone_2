
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('letter_requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('letter_type_id');

            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();

            $table->timestamps();

            // Foreign keys
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('letter_type_id')->references('id')->on('letter_types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('letter_requests');
    }
};
