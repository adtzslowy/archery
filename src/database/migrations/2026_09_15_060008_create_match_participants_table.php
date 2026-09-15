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
        Schema::create('match_participants', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('match_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignUuid('participant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('lane')->nullable();

            $table->timestamps();

            $table->unique([
                'match_id',
                'participant_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_participants');
    }
};
