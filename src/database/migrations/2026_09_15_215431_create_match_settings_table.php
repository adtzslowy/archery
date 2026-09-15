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
        Schema::create('match_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('match_id')
                ->unique()
                ->constrained('matches')
                ->cascadeOnDelete();

            $table->unsignedInteger('distance')->nullable();
            $table->unsignedInteger('ends')->default(6);
            $table->unsignedInteger('arrows_per_end')->default(6);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_settings');
    }
};