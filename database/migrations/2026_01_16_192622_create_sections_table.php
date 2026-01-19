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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. Section 8
            $table->timestamps();
        });

        // Insert Section 8 to Section 37, skipping Section 35
        $sections = [];

        for ($i = 8; $i <= 37; $i++) {
            if ($i === 35) {
                continue;
            }

            $sections[] = [
                'name' => 'Section ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('sections')->insert($sections);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
