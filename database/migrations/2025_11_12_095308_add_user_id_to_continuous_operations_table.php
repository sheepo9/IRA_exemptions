<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('continuous_operations', function (Blueprint $table) {
            // Add the user_id column (after id or wherever you want)
            $table->unsignedBigInteger('user_id')->after('id');

            // Add a foreign key constraint to users table
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('continuous_operations', function (Blueprint $table) {
            // Drop foreign key and column when rolling back
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
