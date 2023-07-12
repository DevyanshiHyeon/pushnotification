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
            $table->boolean('sent_instant')->default(false)->after('is_instant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_message', function (Blueprint $table) {
            $table->dropColumn(['sent_instant']);
        });
    }
};
