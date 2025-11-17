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
        Schema::create('exemption_declarations', function (Blueprint $table) {
            $table->id();
            $table->string('minister_name');
            $table->string('applicant_name');
            $table->string('physical_address');
            $table->text('exemption_sections')->nullable();   // 1.1–1.5
            $table->text('variation_sections')->nullable();   // 2.1–2.5
            $table->date('effective_from');
            $table->date('effective_to');
            $table->date('signed_date');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemption_declarations');
    }
};
