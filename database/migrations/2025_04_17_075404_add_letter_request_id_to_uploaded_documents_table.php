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
        Schema::table('uploaded_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('letter_request_id')->after('id');
    
            $table->foreign('letter_request_id')
                  ->references('id')
                  ->on('letter_requests')
                  ->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('uploaded_documents', function (Blueprint $table) {
            $table->dropForeign(['letter_request_id']);
            $table->dropColumn('letter_request_id');
        });
    }    
};
