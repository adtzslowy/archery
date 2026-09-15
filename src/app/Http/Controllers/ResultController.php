<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $matches = Matches::with('competition')
            ->latest('scheduled_at')
            ->get();

        $match = null;
        $participants = collect();

        if ($request->filled('match')) {

            $match = Matches::with([
                'competition',
                'setting',
                'participants.scores',
            ])->findOrFail($request->match);

            $participants = $match->participants
                ->map(function ($participant) use ($match) {

                    $participant->total_score = $participant->scores
                        ->where('match_id', $match->id)
                        ->sum('point');

                    $participant->total_arrows = $participant->scores
                        ->where('match_id', $match->id)
                        ->count();

                    return $participant;
                })
                ->sortByDesc('total_score')
                ->values();

            $rank = 0;
            $previousScore = null;

            $participants = $participants->map(
                function ($participant) use (&$rank, &$previousScore) {

                    if ($previousScore !== $participant->total_score) {
                        $rank++;
                    }

                    $participant->rank = $rank;

                    $previousScore = $participant->total_score;

                    return $participant;
                }
            );
        }

        return view('dashboard.result.index', compact(
            'matches',
            'match',
            'participants'
        ));
    }
}