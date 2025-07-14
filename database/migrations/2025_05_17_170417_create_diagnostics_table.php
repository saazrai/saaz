<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create tables for the diagnostic assessment system.
     * 
     * This migration creates the core diagnostic testing infrastructure:
     * - diagnostics: Main diagnostic test sessions
     * - diagnostic_domains: High-level knowledge areas (e.g., Security, Cloud Computing)
     * - diagnostic_topics: Specific topics within domains
     * - diagnostic_items: Individual questions with IRT parameters for adaptive testing
     * - diagnostic_responses: User answers to diagnostic questions
     * - concept_diagnostic_item: Many-to-many relationship for question-concept mapping
     */
    public function up(): void
    {
        // Main diagnostic test sessions table
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            
            // Session management
            $table->enum('status', ['in_progress', 'paused', 'completed'])->default('in_progress');
            $table->enum('mode', ['test', 'quick', 'standard', 'indepth'])->default('standard')
                ->comment('Diagnostic test mode: test (20 questions), quick (40 questions), standard (60 questions), indepth (100 questions)');
            
            // Progress tracking
            $table->integer('total_questions')->default(100)->comment('Total questions based on selected mode');
            $table->integer('current_question')->default(0)->comment('Current question index for resuming');
            $table->integer('total_duration_seconds')->nullable()
                ->comment('Total duration of diagnostic session in seconds');
            $table->decimal('score', 5, 2)->nullable()
                ->comment('Final score as percentage (0.00-100.00)');
            
            // Phase tracking for 4-phase system
            $table->integer('current_phase')->default(1)->comment('Current phase (1-4)');
            $table->integer('current_domain')->default(1)->comment('Current domain (1-20)');
            $table->jsonb('phases_completed')->nullable()->comment('Array of completed phases [1,2,3,4]');
            $table->jsonb('domains_completed')->nullable()->comment('Array of completed domains [1,2,3...]');
            $table->jsonb('phase_completion_times')->nullable()->comment('Timestamp for each phase completion');
            $table->jsonb('domain_progress')->nullable()->comment('Progress data per domain');

            // CAT-IRT integration columns
            $table->decimal('ability', 8, 4)->nullable()
                ->comment('IRT theta parameter: estimated user ability (-4 to +4 scale)');
            $table->decimal('standard_error', 8, 4)->nullable()
                ->comment('Standard error of ability estimate for CAT termination');
            $table->jsonb('adaptive_state')->nullable()
                ->comment('Adaptive testing state for resuming sessions');

            $table->timestamps();
            $table->softDeletes();

            // Performance indexes
            $table->index(['user_id', 'status']); // For finding user's active diagnostics
            $table->index('created_at'); // For chronological listing and pagination
            $table->index('status'); // Frequently queried
            $table->index('mode'); // Filter by diagnostic mode
            $table->index(['status', 'mode']); // Combined status and mode queries
            $table->index(['user_id', 'created_at']); // User diagnostic history
            $table->index('deleted_at'); // Soft delete queries
            
            // Added 2025-06-07: Additional composite indexes for performance
            $table->index(['user_id', 'mode', 'created_at'], 'diagnostics_user_mode_created_index');
        });

        // High-level knowledge domains (e.g., "Security and Risk Management")
        Schema::create('diagnostic_domains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            
            // Display and organization
            $table->integer('priority_order')->nullable()->comment('Display order in UI');
            $table->enum('category', ['foundational', 'technical', 'managerial'])->nullable()
                ->comment('Domain categorization for learning paths');
            $table->string('code', 20)->nullable()->comment('Short code for domain (e.g., SRM, IAM)');
            
            // Weighting and visualization
            $table->decimal('weight_percentage', 5, 2)->nullable()
                ->comment('Domain weight in overall assessment (must sum to 100%)');
            $table->string('color', 20)->nullable()->comment('UI color for charts and reports');
            $table->string('icon', 50)->nullable()->comment('Icon identifier for UI display');
            
            // Configuration
            $table->boolean('is_active')->default(true);
            $table->tinyInteger('min_bloom_level')->default(1)->comment('Minimum Bloom\'s taxonomy level');
            $table->tinyInteger('max_bloom_level')->default(6)->comment('Maximum Bloom\'s taxonomy level');
            
            // Learning metadata
            $table->text('learning_objectives')->nullable();
            $table->jsonb('prerequisites')->nullable()->comment('Required knowledge before this domain');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('priority_order');
            $table->index('category');
            $table->index('code');
            $table->index('is_active');
        });

        // Specific topics within domains (e.g., "Access Control" within "Security")
        Schema::create('diagnostic_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained('diagnostic_domains')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Index for domain-based queries
            $table->index('domain_id');
        });

        // Individual diagnostic questions with IRT parameters
        Schema::create('diagnostic_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained('diagnostic_topics')->onDelete('cascade');
            $table->foreignId('type_id')->nullable()->constrained('question_types')->onDelete('set null');
            
            // Question categorization
            $table->enum('dimension', ['Technical', 'Managerial'])
                ->comment('Question focus: Technical=hands-on skills, Managerial=leadership/strategy');
            
            // Question content
            $table->text('content')->comment('The question text/prompt');
            $table->jsonb('options')->nullable()
                ->comment('Multiple choice options as JSON array');
            $table->jsonb('correct_options')
                ->comment('Correct answer(s) as JSON array for multi-select support');
            $table->jsonb('justifications')->nullable()
                ->comment('Explanations for each option as JSON object');
            $table->jsonb('settings')->nullable()
                ->comment('Question-specific configuration (time limits, hints, etc.)');
            
            // Difficulty and cognitive level (V1 Enhanced: simplified structure)
            $table->integer('difficulty_level')->default(3)->comment('1-6 for difficulty levels');
            $table->integer('bloom_level')->default(3)->comment('1-6 for Bloom\'s taxonomy levels');
            $table->decimal('irt_a', 4, 2)->nullable()
                ->comment('IRT discrimination parameter (0.5-3.0 typical range)');
            $table->decimal('irt_b', 4, 2)->nullable()
                ->comment('IRT difficulty parameter (-3.0 to +3.0 scale)');
            $table->decimal('irt_c', 4, 2)->nullable()
                ->comment('IRT guessing parameter (0.0-0.25 for multiple choice)');
            $table->enum('status', ['draft', 'published', 'retired'])->default('published');
            $table->softDeletes();
            $table->timestamps();

            // Performance indexes for question selection
            $table->index(['topic_id', 'status']);
            $table->index(['difficulty_level', 'bloom_level']);
        });

        // User responses to diagnostic questions
        Schema::create('diagnostic_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnostic_id')->constrained('diagnostics')->onDelete('cascade');
            $table->foreignId('diagnostic_item_id')->constrained('diagnostic_items')->onDelete('cascade');
            
            // Response data
            $table->jsonb('user_answer')->nullable()
                ->comment('User response as JSON to support multiple answer types');
            $table->boolean('is_correct')->nullable();
            $table->integer('response_time_seconds')->nullable()
                ->comment('Time taken to answer this specific question in seconds');
            $table->timestamps();
            $table->softDeletes();

            // Performance indexes for analytics queries
            $table->index(['diagnostic_id', 'diagnostic_item_id']);
            $table->index(['diagnostic_id', 'is_correct']);
        });

        // Many-to-many relationship: diagnostic questions can cover multiple concepts
        Schema::create('concept_diagnostic_item', function (Blueprint $table) {
            $table->foreignId('diagnostic_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('concept_id')->constrained()->onDelete('cascade');
            $table->primary(['diagnostic_item_id', 'concept_id']);
            
            // Additional indexes for concept-based queries
            $table->index('concept_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_diagnostic_item');
        Schema::dropIfExists('diagnostic_responses');
        Schema::dropIfExists('diagnostic_items');
        Schema::dropIfExists('diagnostic_topics');
        Schema::dropIfExists('diagnostic_domains');
        Schema::dropIfExists('diagnostics');
    }
};
