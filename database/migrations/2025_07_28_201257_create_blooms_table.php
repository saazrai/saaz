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
        Schema::create('blooms', function (Blueprint $table) {
            $table->id(); // 1-6, serves as the level
            $table->string('name'); // Remember, Understand, Apply, Analyze, Evaluate, Create
            $table->string('code', 3)->unique(); // L1, L2, L3, L4, L5, L6
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('code');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blooms');
    }
};
