<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Matches;
use App\Models\Participant;
use App\Models\Score;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $statistics = [
            'participants' => Participant::count(),
            'competitions' => Competition::count(),
            'matches' => Matches::count(),
            'scores' => Score::count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Upcoming Matches
        |--------------------------------------------------------------------------
        */

        $upcomingMatches = Matches::query()
            ->with([
                'competition',
                'setting',
                'participants',
            ])
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Ongoing Matches
        |--------------------------------------------------------------------------
        */

        $ongoingMatches = Matches::query()
            ->with([
                'competition',
                'setting',
                'participants',
            ])
            ->where('status', 'ongoing')
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Matches
        |--------------------------------------------------------------------------
        */

        $recentMatches = Matches::query()
            ->with([
                'competition',
                'setting',
                'participants',
            ])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('dashboard.index', [
            'statistics' => $statistics,
            'upcomingMatches' => $upcomingMatches,
            'ongoingMatches' => $ongoingMatches,
            'recentMatches' => $recentMatches,
        ]);
    }
}