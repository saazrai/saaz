<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This table enables the diagnostic system to emit events that other
     * platform services can react to, breaking the "data dead end" problem.
     * 
     * Event Types:
     * - proficiency.updated: User's proficiency in a domain changed
     * - weakness.identified: User struggling in a specific area
     * - mastery.achieved: User demonstrated mastery of a domain
     * - misconception.detected: Common error pattern identified
     * - milestone.completed: User completed a learning milestone
     * - improvement.significant: Notable progress detected
     */
    public function up(): void
    {
        Schema::create('diagnostic_events', function (Blueprint $table) {
            $table->id();
            
            // Event identification
            $table->string('event_type', 50)->index()
                ->comment('Type of event (e.g., weakness.identified, mastery.achieved)');
            
            // Event source
            $table->foreignId('user_id')->constrained();
            $table->foreignId('diagnostic_id')->nullable()->constrained()
                ->comment('The diagnostic session that triggered this event');
            $table->foreignId('domain_id')->nullable()->constrained('diagnostic_domains')
                ->comment('Domain this event relates to (if applicable)');
            
            // Event data
            $table->json('payload')
                ->comment('Event-specific data (proficiency scores, topics, recommendations, etc.)');
            
            // Processing status
            $table->boolean('processed')->default(false)->index()
                ->comment('Whether this event has been processed by consumers');
            $table->timestamp('processed_at')->nullable()
                ->comment('When the event was processed');
            $table->string('processed_by')->nullable()
                ->comment('Which service(s) processed this event');
            
            // Error tracking
            $table->boolean('failed')->default(false)
                ->comment('Whether processing failed');
            $table->text('error_message')->nullable()
                ->comment('Error details if processing failed');
            $table->unsignedTinyInteger('retry_count')->default(0)
                ->comment('Number of processing attempts');
            
            // Metadata
            $table->string('priority', 10)->default('normal')
                ->comment('Processing priority: low, normal, high');
            $table->timestamp('expires_at')->nullable()
                ->comment('Event expiration (for time-sensitive events)');
            
            $table->timestamps();
            
            // Indexes for efficient queries
            $table->index(['user_id', 'created_at'], 'idx_user_events');
            $table->index(['event_type', 'processed', 'created_at'], 'idx_pending_events');
            $table->index(['diagnostic_id', 'event_type'], 'idx_diagnostic_events');
            $table->index(['domain_id', 'event_type'], 'idx_domain_events');
            $table->index(['priority', 'processed', 'created_at'], 'idx_priority_queue');
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_events');
    }
};