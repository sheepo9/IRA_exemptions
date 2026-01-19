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

    $table->unsignedBigInteger('exemption_variation_id');
    $table->unsignedBigInteger('section_id');

    $table->foreign('exemption_variation_id', 'evs_ev_fk')
          ->references('id')
          ->on('exemption_variations')
          ->onDelete('cascade');

    $table->foreign('section_id', 'evs_section_fk')
          ->references('id')
          ->on('sections')
          ->onDelete('cascade');

    // 👇 SHORT index name (VERY IMPORTANT)
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
