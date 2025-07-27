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
        Schema::create('privacy_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->boolean('marketing_consent')->default(false);
            $table->boolean('analytics_consent')->default(false);
            $table->boolean('third_party_consent')->default(false);
            
            $table->timestamp('consent_given_at')->nullable();
            $table->string('consent_version')->nullable();
            $table->jsonb('consent_history')->nullable();
            
            $table->timestamps();
            
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_settings');
    }
};
