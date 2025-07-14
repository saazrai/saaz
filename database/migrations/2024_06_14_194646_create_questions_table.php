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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('question_types')
                ->restrictOnDelete(); // Prevent deletion of question types with questions
            $table->text('content');
            $table->jsonb('options');
            $table->jsonb('correct_options');
            $table->jsonb('justifications')->nullable();
            $table->jsonb('settings')->nullable();        // Store dynamic type-specific config

            // Simplified V1 Enhanced structure - no external dependencies
            $table->integer('difficulty_level')->default(3); // 1-6 for Bloom's taxonomy levels
            $table->integer('bloom_level')->default(3); // 1-6 for Bloom's taxonomy levels
            $table->float('irt_difficulty_b')->nullable(); // IRT: difficulty
            $table->float('irt_discrimination_a')->nullable(); // IRT: discrimination
            $table->float('irt_guessing_c')->nullable(); // IRT: guessing (for 3PL, optional)

            $table->enum('status', ['draft', 'published', 'retired'])->default('published');
            $table->timestamps();
            $table->softDeletes();

            // Performance indexes
            $table->index('type_id'); // Foreign key index
            $table->index('bloom_level'); // Bloom level index
            $table->index('difficulty_level'); // Difficulty level index
            $table->index('status'); // Frequently queried
            $table->index(['status', 'deleted_at']); // Active questions filter
            $table->index(['bloom_level', 'difficulty_level', 'status']); // Question selection criteria
            $table->index(['type_id', 'status', 'deleted_at']); // Type-based queries
            $table->index('deleted_at'); // Soft delete queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
