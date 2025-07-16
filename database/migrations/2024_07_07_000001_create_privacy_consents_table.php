<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('privacy_consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('regulation'); // e.g., GDPR, CCPA, PIPEDA
            $table->string('consent_version'); // e.g., "1.0", "2025.01"

            $table->boolean('is_consent_given')->default(false);
            $table->timestamp('consent_given_at')->nullable();
            $table->string('consent_type')->nullable(); // For backward compatibility
            $table->timestamp('consented_at')->nullable(); // Alias for consent_given_at
            $table->timestamp('withdrawn_at')->nullable();
            $table->ipAddress('withdrawal_ip')->nullable();

            $table->jsonb('consent_preferences')->nullable(); // e.g., {"ads": false, "analytics": true}
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('consent_region')->nullable(); // Optional: inferred from IP or user settings

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('privacy_consents');
    }
};
