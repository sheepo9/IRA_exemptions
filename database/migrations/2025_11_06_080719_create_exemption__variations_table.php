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
        Schema::create('exemption_variations', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
        $table->string('address');
       // $table->text('sections_sought');  // Sections from which exemption/variation is sought
        $table->text('categories_affected')->nullable();  // Employees affected
        $table->string('representative_name');
        $table->string('position')->nullable();
        $table->date('application_date');
            $table->timestamps();
        });
                 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemption_variations');
    }
};
