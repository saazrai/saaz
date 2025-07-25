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
        Schema::table('diagnostic_items', function (Blueprint $table) {
            $table->foreignId('topic_id')->nullable()->after('id')->constrained('diagnostic_topics')->onDelete('cascade');
            $table->index('topic_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diagnostic_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('topic_id');
        });
    }
};
