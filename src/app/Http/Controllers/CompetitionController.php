<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Competition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompetitionController extends Controller
{
    /**
     * Display a listing of competitions.
     */
    public function index(): View
    {
        $competitions = Competition::with('category')
            ->latest()
            ->paginate(10);

        return view('dashboard.competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new competition.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('dashboard.competitions.create', compact('categories'));
    }

    /**
     * Store a newly created competition.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'uuid',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'status' => [
                'required',
                'in:draft,scheduled,ongoing,completed,cancelled',
            ],
        ]);

        Competition::create($validated);

        return redirect()
            ->route('competition.index')
            ->with('success', 'Competition created successfully.');
    }

    /**
     * Display the specified competition.
     */
    public function show(Competition $competition): View
    {
        $competition->load('category');

        return view('dashboard.competitions.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified competition.
     */
    public function edit(Competition $competition): View
    {
        $categories = Category::orderBy('name')->get();

        return view('dashboard.competitions.edit', compact(
            'competition',
            'categories'
        ));
    }

    /**
     * Update the specified competition.
     */
    public function update(
        Request $request,
        Competition $competition
    ): RedirectResponse {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'uuid',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'status' => [
                'required',
                'in:draft,scheduled,ongoing,completed,cancelled',
            ],
        ]);

        $competition->update($validated);

        return redirect()
            ->route('competition.show', $competition)
            ->with('success', 'Competition updated successfully.');
    }

    /**
     * Remove the specified competition.
     */
    public function destroy(Competition $competition): RedirectResponse
    {
        $competition->delete();

        return redirect()
            ->route('competition.index')
            ->with('success', 'Competition deleted successfully.');
    }
}