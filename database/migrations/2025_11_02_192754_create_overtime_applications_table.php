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
        Schema::create('overtime_applications', function (Blueprint $table) {
            $table->id();
             $table->string('employer_name');
        $table->string('contact_person');
        $table->string('postal_address');
        $table->string('tel_no');
        $table->string('email');
        $table->text('motivation')->nullable();
        $table->string('proposed_daily_limit')->nullable();
        $table->string('proposed_weekly_limit')->nullable();
        $table->boolean('work_on_sundays')->default(false);
        $table->text('class_of_employees')->nullable();
               $table->string('period_sought')->nullable();
        $table->date('signature_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_applications');
    }
};
