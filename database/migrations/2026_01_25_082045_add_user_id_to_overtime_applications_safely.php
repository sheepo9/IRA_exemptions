<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add column (no FK yet)
        Schema::table('overtime_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // 2. Get a safe fallback user (admin / first user)
        $fallbackUserId = DB::table('users')->orderBy('id')->value('id');

        if (!$fallbackUserId) {
            throw new Exception('No users found. Cannot assign overtime_applications.user_id');
        }

        // 3. Fix ALL invalid user references
        DB::statement("
            UPDATE overtime_applications
            SET user_id = {$fallbackUserId}
            WHERE user_id IS NULL
               OR user_id NOT IN (SELECT id FROM users)
        ");

        // 4. Add FK constraint
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
