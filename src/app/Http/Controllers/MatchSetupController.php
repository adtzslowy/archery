<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Matches;
use App\Models\Participant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class MatchSetupController extends Controller
{
    /**
     * Display match setup.
     */
    public function index(Request $request): View
    {
        $matches = Matches::with('competition')
            ->latest()
            ->get();

        $match = null;
        $participants = collect();
        $availableParticipants = collect();

        if ($request->filled('match')) {
            $match = Matches::with([
                'competition',
                'participants',
            ])->findOrFail($request->match);

            $participants = $match->participants;

            $participantIds = $participants
                ->pluck('id');

            $availableParticipants = Participant::query()
                ->whereNotIn('id', $participantIds)
                ->orderBy('name')
                ->get();
        }

        return view('dashboard.match-setup.index', compact(
            'matches',
            'match',
            'participants',
            'availableParticipants'
        ));
    }

    /**
     * Add participant to match.
     */
    public function storeParticipant(
        Request $request,
        Matches $match
    ): RedirectResponse {
        $validated = $request->validate([
            'participant_id' => [
                'required',
                'uuid',
                'exists:participants,id',
            ],
            'lane' => [
                'nullable',
                'integer',
                'min:1',
            ],
        ]);

        $exists = $match->participants()
            ->where('participant_id', $validated['participant_id'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Participant is already registered in this match.');
        }

        if (!empty($validated['lane'])) {
            $laneExists = $match->participants()
                ->wherePivot('lane', $validated['lane'])
                ->exists();

            if ($laneExists) {
                return back()
                    ->withInput()
                    ->with('error', 'Lane ' . $validated['lane'] . ' is already assigned.');
            }
        }

        $match->participants()->attach(
            $validated['participant_id'],
            [
                'id' => Str::uuid(),
                'lane' => $validated['lane'] ?? null,
            ]
        );

        return back()
            ->with('success', 'Participant added to the match.');
    }

    /**
     * Update participant lane.
     */
    public function updateParticipant(
        Request $request,
        Matches $match,
        Participant $participant
    ): RedirectResponse {
        $validated = $request->validate([
            'lane' => [
                'nullable',
                'integer',
                'min:1',
            ],
        ]);

        // Pastikan participant memang terdaftar di match
        $exists = $match->participants()
            ->where('participant_id', $participant->id)
            ->exists();

        if (! $exists) {
            return back()
                ->with('error', 'Participant is not registered in this match.');
        }

        // Cek apakah lane sudah digunakan participant lain
        if (! empty($validated['lane'])) {

            $laneExists = $match->participants()
                ->wherePivot('lane', $validated['lane'])
                ->where('participant_id', '!=', $participant->id)
                ->exists();

            if ($laneExists) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Lane ' . $validated['lane'] . ' is already assigned to another participant.'
                    );
            }
        }

        $match->participants()->updateExistingPivot(
            $participant->id,
            [
                'lane' => $validated['lane'] ?? null,
            ]
        );

        return back()
            ->with('success', 'Participant lane updated.');
    }

    /**
     * Remove participant from match.
     */
    public function destroyParticipant(
        Matches $match,
        Participant $participant
    ): RedirectResponse {
        $match->participants()->detach($participant->id);

        return back()
            ->with('success', 'Participant removed from the match.');
    }

    public function updateSettings(
        Request $request,
        Matches $match
    ): RedirectResponse {
        $validated = $request->validate([
            'distance' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'ends' => [
                'required',
                'integer',
                'min:1',
            ],
            'arrows_per_end' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $match->setting()->updateOrCreate(
            [],
            $validated
        );

        return back()->with(
            'success',
            'Match settings saved successfully.'
        );
    }
}
