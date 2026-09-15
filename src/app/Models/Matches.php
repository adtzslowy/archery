<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Matches extends Model
{
    use HasUuids;

    protected $fillable = [
        'competition_id',
        'name',
        'scheduled_at',
        'location',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
        ];
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            Participant::class,
            'match_participants',
            'match_id',
            'participant_id'
        )
            ->withPivot('id', 'lane')
            ->withTimestamps();
    }

    public function scores(): HasMany
    {
        return $this->hasMany(
            Score::class,
            'match_id'
        );
    }

    public function setting(): HasOne
    {
        return $this->hasOne(MatchSetting::class, 'match_id');
    }
}
