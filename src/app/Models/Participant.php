<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasUuids;

    protected $fillable = [
        'participant_number',
        'name',
        'gender',
        'birth_date',
        'school',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(
            Matches::class,
            'match_participants',
            'participant_id',
            'match_id'
        )
            ->withPivot('id', 'lane')
            ->withTimestamps();
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }
}