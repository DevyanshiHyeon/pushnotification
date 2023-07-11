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
            if (Schema::hasColumn('all_messages','is_instant')){
                $table->dropColumn('is_instant');
            }
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
