<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MatchParticipant extends Model
{
    use HasUuids;

    protected $fillable = [
        'match_id',
        'participant_id',
        'lane',
    ];

    protected function casts(): array
    {
        return [
            'lane' => 'integer',
        ];
    }
}