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
        // Create diagnostic_phases table
        Schema::create('diagnostic_phases', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('order_sequence')->comment('Display order (1, 2, 3, 4)');
            $table->integer('min_questions_per_domain')->default(5);
            $table->integer('target_domains')->default(5)->comment('Number of domains in this phase');
            $table->jsonb('completion_criteria')->nullable()->comment('Criteria for completing this phase');
            $table->boolean('is_active')->default(true);
            $table->string('color', 20)->nullable()->comment('UI color for phase display');
            $table->string('icon', 50)->nullable()->comment('Icon for phase display');
            $table->timestamps();
            
            $table->index('order_sequence');
            $table->index('is_active');
        });
        
        // Add phase_id to diagnostic_domains table
        Schema::table('diagnostic_domains', function (Blueprint $table) {
            $table->foreignId('phase_id')->nullable()->after('id')->constrained('diagnostic_phases')->onDelete('cascade');
            $table->integer('phase_order')->nullable()->after('phase_id')->comment('Order within the phase (1-5)');
            
            $table->index(['phase_id', 'phase_order']);
        });
        
        // Update diagnostics table to reference phases properly
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->foreignId('current_phase_id')->nullable()->after('current_phase')->constrained('diagnostic_phases')->onDelete('set null');
            $table->jsonb('target_phases')->nullable()->after('current_phase_id')->comment('Array of phase IDs for multi-phase assessments');
            $table->jsonb('phase_progress')->nullable()->after('target_phases')->comment('Progress data per phase');
            
            $table->index('current_phase_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->dropForeign(['current_phase_id']);
            $table->dropColumn(['current_phase_id', 'target_phases', 'phase_progress']);
        });
        
        Schema::table('diagnostic_domains', function (Blueprint $table) {
            $table->dropForeign(['phase_id']);
            $table->dropColumn(['phase_id', 'phase_order']);
        });
        
        Schema::dropIfExists('diagnostic_phases');
    }
};