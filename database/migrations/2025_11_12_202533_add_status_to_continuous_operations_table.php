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
        Schema::table('continuous_operations', function (Blueprint $table) {
                    $table->string('status')->default('Pending');
        $table->string('approved_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('continuous_operations', function (Blueprint $table) {
            $table->dropColumn(['status', 'approved_document']);
        });
    }
};
