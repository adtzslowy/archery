<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('match_participants', function (Blueprint $table) {
            $table->unique(
                ['match_id', 'lane'],
                'match_participants_match_id_lane_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('match_participants', function (Blueprint $table) {
            $table->dropUnique(
                'match_participants_match_id_lane_unique'
            );
        });
    }
};