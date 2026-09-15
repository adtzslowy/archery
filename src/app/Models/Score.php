<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    use HasUuids;

    protected $fillable = [
        'match_id',
        'participant_id',
        'end',
        'shot_number',
        'point',
    ];

    protected function casts(): array
    {
        return [
            'end' => 'integer',
            'shot_number' => 'integer',
            'point' => 'integer',
        ];
    }

    public function match(): BelongsTo
    {
        return $this->belongsTo(
            Matches::class,
            'match_id'
        );
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }
}
