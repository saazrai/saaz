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
        Schema::table('diagnostics', function (Blueprint $table) {
            // Drop mode-related columns and indexes
            $table->dropIndex(['status', 'mode']);
            $table->dropIndex('diagnostics_user_mode_created_index');
            $table->dropIndex(['mode']);
            $table->dropColumn('mode');
            
            // Update total_questions default and comment
            $table->integer('total_questions')->default(20)->comment('Total questions per phase (20 questions = 1 question per domain)')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->enum('mode', ['test', 'quick', 'standard', 'indepth'])->default('standard')
                ->comment('Diagnostic test mode: test (20 questions), quick (40 questions), standard (60 questions), indepth (100 questions)')->after('status');
            $table->index('mode');
            $table->index(['status', 'mode']);
            $table->index(['user_id', 'mode', 'created_at'], 'diagnostics_user_mode_created_index');
            
            $table->integer('total_questions')->default(100)->comment('Total questions based on selected mode')->change();
        });
    }
};
