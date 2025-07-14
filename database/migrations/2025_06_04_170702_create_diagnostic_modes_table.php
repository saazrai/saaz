<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the diagnostic_modes table for configurable test types.
     * 
     * Defines different diagnostic test modes (test, quick, standard, in-depth)
     * with their configurations including:
     * - Question counts and time limits
     * - Cooldown periods between attempts
     * - UI customization (colors, icons, badges)
     * - Pricing for premium modes
     */
    public function up(): void
    {
        Schema::create('diagnostic_modes', function (Blueprint $table) {
            $table->id();
            // Core configuration
            $table->string('slug')->unique()->comment('URL-friendly identifier');
            $table->string('name')->comment('Display name for the mode');
            $table->integer('question_count')->comment('Number of questions in this mode');
            $table->integer('duration_minutes')->comment('Time limit in minutes');
            $table->integer('cooldown_hours')->nullable()->comment('Hours before retake allowed');
            
            // Visibility and access control
            $table->boolean('is_active')->default(true);
            $table->boolean('is_dev_only')->default(false)->comment('Only visible in development');
            $table->integer('sort_order')->default(0)->comment('Display order in UI');
            
            // UI customization
            $table->string('color_scheme')->default('blue')->comment('UI theme color');
            $table->string('icon')->nullable()->comment('Icon class or path');
            $table->text('description')->nullable();
            $table->jsonb('features')->nullable()->comment('Feature list for marketing display');
            $table->decimal('price', 10, 2)->default(0)->comment('Cost for premium modes');
            $table->string('badge_text')->nullable()->comment('Badge shown on mode card');
            $table->timestamps();
            
            // Performance indexes
            $table->index('slug'); // URL lookup
            $table->index('is_active'); // Filter active modes
            $table->index('sort_order'); // Ordered display
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_modes');
    }
};
