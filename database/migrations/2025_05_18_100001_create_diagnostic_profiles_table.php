<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This table stores persistent learner proficiency per domain.
     * Unlike the 'diagnostics' table which records individual test sessions,
     * this maintains the current state of a user's knowledge in each domain.
     */
    public function up(): void
    {
        if (Schema::hasTable('diagnostic_profiles')) {
            return;
        }

        Schema::create('diagnostic_profiles', function (Blueprint $table) {
            $table->id();

            // User and domain (unique combination)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('domain_id')->constrained('diagnostic_domains');

            // Current proficiency state
            $table->decimal('proficiency', 3, 2)->default(0.5)
                ->comment('Current proficiency level (0-1 scale)');
            $table->decimal('confidence', 3, 2)->default(0.0)
                ->comment('Confidence in proficiency estimate (0-1 scale)');
            $table->unsignedTinyInteger('last_bloom_level')->default(3)
                ->comment('Last Bloom taxonomy level achieved (1-5, no Create)');

            // Historical tracking
            $table->unsignedInteger('questions_answered')->default(0);
            $table->unsignedInteger('questions_correct')->default(0);
            $table->json('bloom_distribution')->nullable()
                ->comment('Distribution of questions by Bloom level, e.g. {"1": 5, "2": 8, "3": 12}');

            // Performance metrics
            $table->decimal('average_response_time', 8, 2)->nullable()
                ->comment('Average seconds per question in this domain');
            $table->unsignedTinyInteger('consecutive_correct')->default(0)
                ->comment('Current streak of correct answers');
            $table->unsignedTinyInteger('consecutive_incorrect')->default(0)
                ->comment('Current streak of incorrect answers');

            // Temporal tracking
            $table->timestamp('first_assessed_at')->nullable();
            $table->timestamp('last_assessed_at')->nullable();

            // Metadata
            $table->json('strengths')->nullable()
                ->comment('Identified strong topics within domain');
            $table->json('weaknesses')->nullable()
                ->comment('Identified weak topics within domain');

            $table->timestamps();

            // Indexes
            $table->unique(['user_id', 'domain_id'], 'unique_user_domain');
            $table->index(['user_id', 'last_assessed_at'], 'idx_user_last_assessed');
            $table->index(['user_id', 'proficiency'], 'idx_user_proficiency');
            $table->index(['domain_id', 'proficiency'], 'idx_domain_proficiency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_profiles');
    }
};
