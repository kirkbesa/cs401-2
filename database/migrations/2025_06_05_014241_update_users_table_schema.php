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
        Schema::table('users', function (Blueprint $table) {
            // Add or modify columns
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name', 30)->after('password');
            } else {
                $table->string('name', 30)->change();
            }

            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->rememberToken();
            }

            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('remember_token');
            }

            if (!Schema::hasColumn('users', 'registration_date')) {
                $table->timestamp('registration_date')->useCurrent()->after('email_verified_at');
            }

            if (!Schema::hasColumn('users', 'last_login_date')) {
                $table->timestamp('last_login_date')->nullable()->after('registration_date');
            }

            // Remove default timestamps if they exist
            if (Schema::hasColumn('users', 'created_at') && Schema::hasColumn('users', 'updated_at')) {
                $table->dropTimestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'remember_token',
                'email_verified_at',
                'registration_date',
                'last_login_date',
            ]);

            // Optionally re-add timestamps if needed
            $table->timestamps();
        });
    }
};
