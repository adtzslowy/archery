<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Match;
use App\Models\Matches;
use App\Models\Participant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatchController extends Controller
{
    /**
     * Display a listing of matches.
     */
    public function index(Request $request): View
    {
        $query = Matches::with('competition')
            ->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($query) use ($search) {
                $query->where('name', 'ilike', "%{$search}%")
                    ->orWhere('location', 'ilike', "%{$search}%")
                    ->orWhereHas('competition', function ($query) use ($search) {
                        $query->where('name', 'ilike', "%{$search}%");
                    });
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $matches = $query
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.matches.index', compact('matches'));
    }

    /**
     * Show the form for creating a new match.
     */
    public function create(): View
    {
        $competitions = Competition::orderBy('name')->get();

        return view('dashboard.matches.create', compact('competitions'));
    }

    /**
     * Store a newly created match.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'competition_id' => [
                'required',
                'uuid',
                'exists:competitions,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'scheduled_at' => [
                'nullable',
                'date',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:scheduled,ongoing,completed,cancelled',
            ],
        ]);

        $match = Matches::create($validated);

        return redirect()
            ->route('match.show', $match)
            ->with('success', 'Match created successfully.');
    }

    /**
     * Display the specified match.
     */
    public function show(Matches $match): View
    {
        $match->load([
            'competition',
            'participants',
            'setting',
        ]);

        $availableParticipants = Participant::query()
            ->whereNotIn(
                'id',
                $match->participants->pluck('id')
            )
            ->orderBy('name')
            ->get();

        return view('dashboard.match-setup.show', compact(
            'match',
            'availableParticipants'
        ));
    }

    /**
     * Show the form for editing the specified match.
     */
    public function edit(Matches $match): View
    {
        $competitions = Competition::orderBy('name')->get();

        return view('dashboard.matches.edit', compact(
            'match',
            'competitions'
        ));
    }

    /**
     * Update the specified match.
     */
    public function update(
        Request $request,
        Matches $match
    ): RedirectResponse {
        $validated = $request->validate([
            'competition_id' => [
                'required',
                'uuid',
                'exists:competitions,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'scheduled_at' => [
                'nullable',
                'date',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:scheduled,ongoing,completed,cancelled',
            ],
        ]);

        $match->update($validated);

        return redirect()
            ->route('match.show', $match)
            ->with('success', 'Match updated successfully.');
    }

    /**
     * Remove the specified match.
     */
    public function destroy(Matches $match): RedirectResponse
    {
        $match->delete();

        return redirect()
            ->route('match.index')
            ->with('success', 'Match deleted successfully.');
    }
}
