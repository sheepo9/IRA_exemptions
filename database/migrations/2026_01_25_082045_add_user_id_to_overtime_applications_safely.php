<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('overtime_applications', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id');
        });

        // Assign existing records to admin (or system user)
        DB::table('overtime_applications')
            ->whereNull('user_id')
            ->update(['user_id' => 3]); // make sure user ID 3 exists

        Schema::table('overtime_applications', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('overtime_applications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
