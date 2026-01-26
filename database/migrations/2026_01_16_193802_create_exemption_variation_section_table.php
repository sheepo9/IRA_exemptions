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
   Schema::create('exemption_variation_section', function (Blueprint $table) {
    $table->id();

    $table->foreignId('exemption_variation_id')
          ->constrained('exemption_variations')
          ->cascadeOnDelete();

    $table->foreignId('section_id')
          ->constrained('sections')
          ->cascadeOnDelete();

    $table->timestamps();

    $table->unique(
        ['exemption_variation_id', 'section_id'],
        'evs_unique'
    );
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exemption_variation_section');
    }
};
