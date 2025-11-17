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
        Schema::create('exemption_applications', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
        $table->string('physical_address')->nullable();
        $table->string('postal_address')->nullable();
        $table->string('phone')->nullable();
        $table->string('fax')->nullable();
        $table->string('email')->nullable();
        $table->string('sector')->nullable();
        $table->integer('num_employees')->nullable();
        $table->boolean('submitted_first_report')->default(false);
        $table->text('report_reason')->nullable();
        $table->date('report_date')->nullable();
        $table->text('supporting_statement')->nullable();
        $table->text('actions_taken')->nullable();
        $table->string('representative_name')->nullable();
        $table->string('position')->nullable();
        $table->date('date_submitted')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemption_applications');
    }
};
