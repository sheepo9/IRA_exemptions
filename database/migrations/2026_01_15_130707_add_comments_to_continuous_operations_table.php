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
            $table->text('staff_member_comment')->nullable()->after('status');
            $table->text('dd_comment')->nullable()->after('staff_member_comment');
            $table->text('ded_comment')->nullable()->after('dd_comment');
            $table->text('ed_comment')->nullable()->after('ded_comment');
            $table->text('minister_comment')->nullable()->after('ed_comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('continuous_operations', function (Blueprint $table) {
            $table->dropColumn([
                'staff_member_comment',
                'dd_comment',
                'ded_comment',
                'ed_comment',
                'minister_comment',
        ]);
        });
    }
};

