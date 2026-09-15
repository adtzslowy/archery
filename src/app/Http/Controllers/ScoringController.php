<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Participant;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoringController extends Controller
{
    /**
     * Display the scoring page.
     */
    public function index(Request $request)
    {
        $matches = Matches::with('competition')
            ->orderBy('scheduled_at')
            ->get();

        $match = null;
        $participants = collect();

        if ($request->filled('match')) {
            $match = Matches::with([
                'competition',
                'setting',
                'participants',
                'scores',
            ])->findOrFail($request->match);

            $participants = $match->participants;
        }

        return view('dashboard.scoring.index', compact(
            'matches',
            'match',
            'participants',
        ));
    }


    /**
     * Store or update a score.
     */
    public function store(Request $request, Matches $match)
    {
        $validated = $request->validate([
            'participant_id' => ['required', 'uuid', 'exists:participants,id'],
            'end' => ['required', 'integer', 'min:1'],
            'shots' => ['required', 'array'],
            'shots.*' => ['nullable', 'integer', 'min:0', 'max:10'],
        ]);

        $participant = $match->participants()
            ->where('participants.id', $validated['participant_id'])
            ->firstOrFail();

        foreach ($validated['shots'] as $shotNumber => $point) {

            if ($point === null || $point === '') {
                continue;
            }

            Score::updateOrCreate(
                [
                    'match_id' => $match->id,
                    'participant_id' => $participant->id,
                    'end' => $validated['end'],
                    'shot_number' => $shotNumber,
                ],
                [
                    'point' => $point,
                ]
            );
        }

        return redirect()->route('scoring.participant', [
            'match' => $match->id,
            'participant' => $participant->id,
            'end' => $validated['end'],
        ])->with('success', "End {$validated['end']} berhasil disimpan.");
    }

    public function participant(Matches $match, Participant $participant)
    {
        $participantExists = $match->participants()
            ->where('participants.id', $participant->id)
            ->exists();

        abort_unless($participantExists, 404);

        $match->load([
            'competition',
            'setting',
        ]);

        $participant->load([
            'scores' => function ($query) use ($match) {
                $query->where('match_id', $match->id);
            },
        ]);

        return view('dashboard.scoring.participant', compact(
            'match',
            'participant'
        ));
    }
}
