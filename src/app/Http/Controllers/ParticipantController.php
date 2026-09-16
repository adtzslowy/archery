<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::latest()->paginate(10);

        return view('dashboard.participants.index', compact('participants'));
    }

    public function create()
    {
        return view('dashboard.participants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'participant_number' => [
                'required',
                'string',
                'max:50',
                'unique:participants,participant_number',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'gender' => [
                'nullable',
                'in:male,female',
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],
        ]);

        Participant::create($validated);

        return redirect()
            ->route('partisipan.index')
            ->with('success', 'Participant created successfully.');
    }

    public function show(Participant $participant)
    {
        return view('dashboard.participants.show', compact('participant'));
    }

    public function edit(Participant $participant)
    {
        return view('dashboard.participants.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'participant_number' => [
                'required',
                'string',
                'max:50',
                'unique:participants,participant_number,' . $participant->id,
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'gender' => [
                'nullable',
                'in:male,female',
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],
        ]);

        $participant->update($validated);

        return redirect()
            ->route('partisipan.show', $participant)
            ->with('success', 'Participant updated successfully.');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();

        return redirect()
            ->route('partisipan.index')
            ->with('success', 'Participant deleted successfully.');
    }
}
