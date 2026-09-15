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
        Schema::table('scores', function (Blueprint $table) {
            $table->unsignedInteger('end')
                ->after('participant_id');
        });

        Schema::table('scores', function (Blueprint $table) {
            $table->dropUnique([
                'match_id',
                'participant_id',
                'shot_number',
            ]);

            $table->unique([
                'match_id',
                'participant_id',
                'end',
                'shot_number',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropUnique([
                'match_id',
                'participant_id',
                'end',
                'shot_number',
            ]);

            $table->unique([
                'match_id',
                'participant_id',
                'shot_number',
            ]);

            $table->dropColumn('end');
        });
    }
};