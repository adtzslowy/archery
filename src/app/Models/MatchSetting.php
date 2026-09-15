<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchSetting extends Model
{
    use HasUuids;

    protected $fillable = [
        'match_id',
        'distance',
        'ends',
        'arrows_per_end',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(Matches::class);
    }
}