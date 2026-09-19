<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Matches;

class LandingController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->with([
                'competitions.matches.participants',
                'competitions.matches.scores',
            ])
            ->get();

        $matches = Matches::query()
            ->with([
                'competition.category',
                'participants',
                'scores',
            ])
            ->whereIn('status', [
                'scheduled',
                'ongoing',
            ])
            ->orderBy('scheduled_at')
            ->get();

        return view('welcome', compact(
            'categories',
            'matches',
        ));
    }

    public function about()
    {
        return $this->index();
    }

    public function schedule()
    {
        return $this->index();
    }

    public function brackets()
    {
        return $this->index();
    }
}