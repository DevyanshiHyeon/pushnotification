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
        Schema::table('all_messages', function (Blueprint $table) {
            $table->boolean('is_instant')->default(false)->after('perent_id')->nullable();
            $table->boolean('is_active')->default(true)->after('is_instant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_messages', function (Blueprint $table) {
            $table->dropColumn(['is_instant', 'is_active']);
        });
    }
};
