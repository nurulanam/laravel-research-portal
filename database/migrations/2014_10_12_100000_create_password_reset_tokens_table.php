<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Laravel 9 renamed the password reset table to "password_reset_tokens".
     * Existing installations still have the old "password_resets" table; the
     * rename is handled by the
     * 2026_10_27_000000_rename_password_resets_to_password_reset_tokens
     * migration, so this migration only has to do something on fresh installs.
     */
    public function up(): void
    {
        if (Schema::hasTable('password_reset_tokens') || Schema::hasTable('password_resets')) {
            return;
        }

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
