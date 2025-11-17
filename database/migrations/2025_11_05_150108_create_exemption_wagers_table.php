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
        Schema::create('exemption_wagers', function (Blueprint $table) {
            $table->id();
                    $table->string('applicant_name');
        $table->string('physical_address');
        $table->string('postal_address')->nullable();
        $table->string('phone')->nullable();
        $table->string('fax')->nullable();
        $table->string('email')->nullable();
        $table->string('sector_industry');
        $table->string('wage_order_name');
        $table->text('detailed_statement')->nullable();
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
        Schema::dropIfExists('exemption_wagers');
    }
};
