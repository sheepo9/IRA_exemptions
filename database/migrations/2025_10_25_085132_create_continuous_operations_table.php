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
        Schema::create('continuous_operations', function (Blueprint $table) {
            $table->id();
             $table->string('employer_name');
            $table->string('registration_number')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->text('nature_of_business')->nullable();
            $table->longText('motivation')->nullable();
            $table->string('period')->nullable();
            $table->text('employee_categories')->nullable();
            $table->integer('number_of_shifts')->nullable();
            $table->integer('hours_per_shift')->nullable();
            $table->string('off_days')->nullable();
            $table->string('shift_roster')->nullable(); // uploaded file path
            $table->string('signature')->nullable();
            $table->date('date_signed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('continuous_operations');
    }
};
