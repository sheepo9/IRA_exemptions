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
        Schema::table('overtime_applications', function (Blueprint $table) {
            $table->text('staff_comment')->nullable()->after('signature_date');
            $table->text('DD_comment')->nullable()->after('staff_comment');
            $table->text('DED_comment')->nullable()->after('DD_comment');
            $table->text('ED_comment')->nullable()->after('DED_comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('overtime_applications', function (Blueprint $table) {
           $table->dropColumn([
                'staff_comment',
                'DD_comment',
                'DED_comment',
                'ED_comment',
            ]);
        });
    }
};
