<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the sample quiz analytics system.
     *
     * This migration creates the sample quiz infrastructure following
     * the same normalized pattern as the main diagnostic system:
     * - sample_quiz_assessments: Main quiz sessions (like 'diagnostics')
     * - sample_quiz_responses: Individual question responses (like 'diagnostic_responses')
     */
    public function up(): void
    {
        // Sample quiz assessments - Main quiz sessions
        Schema::create('sample_quiz_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 100)->unique()->comment('Anonymous session identifier');
            
            // Assessment metadata
            $table->integer('total_questions')->comment('Total number of questions in the sample quiz');
            $table->integer('score')->nullable()->comment('Final percentage score (0-100)');
            $table->integer('completion_time_seconds')->nullable()->comment('Total time taken to complete');
            
            // Session tracking
            $table->enum('status', ['in_progress', 'completed'])->default('in_progress');
            $table->string('user_agent', 500)->nullable();
            $table->string('ip_address', 45)->nullable()->comment('IPv6 compatible');
            
            // Timestamps
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            // Indexes for analytics queries - following diagnostic pattern
            $table->index('status');
            $table->index('completed_at');
            $table->index(['status', 'completed_at']);
            $table->index('score');
        });

        // Sample quiz responses - Individual question responses (normalized like diagnostic_responses)
        Schema::create('sample_quiz_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_quiz_assessment_id')
                ->constrained('sample_quiz_assessments')
                ->onDelete('cascade');
            $table->foreignId('diagnostic_item_id')
                ->constrained('diagnostic_items')
                ->onDelete('cascade')
                ->comment('Reference to the diagnostic question item');
            
            // Question sequence for UI display order
            $table->integer('question_sequence')->comment('Question order in the assessment (1, 2, 3...)');
            
            // Response data - following diagnostic_responses pattern exactly
            $table->jsonb('user_answer')->nullable()->comment('User response as JSON to support multiple answer types');
            $table->boolean('is_correct')->nullable()->comment('Whether the response was correct');
            $table->integer('response_time_seconds')->nullable()->comment('Time taken to answer this question');
            $table->jsonb('metadata')->nullable()->comment('Additional response metadata (e.g., commands for type 7)');
            
            $table->timestamps();
            
            // Indexes for analytics queries - optimized for performance
            $table->index(['sample_quiz_assessment_id', 'question_sequence']);
            $table->index(['diagnostic_item_id', 'is_correct']);
            $table->index(['sample_quiz_assessment_id', 'is_correct']); // For score calculations
        });

        // Sample quiz questions mapping - defines which diagnostic_items are used in sample quiz
        Schema::create('sample_quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnostic_item_id')
                ->constrained('diagnostic_items')
                ->onDelete('cascade')
                ->comment('Reference to the diagnostic question item');
            
            $table->integer('display_order')->comment('Order of question in sample quiz (1, 2, 3...)');
            
            $table->timestamps();
            
            // Ensure unique diagnostic items and proper ordering
            $table->unique('diagnostic_item_id');
            $table->index('display_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_quiz_responses');
        Schema::dropIfExists('sample_quiz_questions');
        Schema::dropIfExists('sample_quiz_assessments');
    }
};