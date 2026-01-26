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
       Schema::table('exemption_variations', function (Blueprint $table) {
            $table->text('reviewer_comments')->nullable()->after('application_date');
            $table->text('minister_comments')->nullable()->after('reviewer_comments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('exemption_variations', function (Blueprint $table) {
            $table->dropColumn([
                'reviewer_comments',
                'minister_comments',
            ]);
              });
    }
};
