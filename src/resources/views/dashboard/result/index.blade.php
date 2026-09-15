@extends('layouts.app')

@section('title', 'Results')

@section('content')

    <div class="space-y-6">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div>
            <h1 class="text-2xl font-semibold tracking-tight">
                Results
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                View match results and participant rankings.
            </p>
        </div>


        {{-- =========================================================
            MATCH SELECTOR
        ========================================================== --}}

        <x-ui.card>

            <x-ui.card-header>

                <h2 class="text-base font-semibold">
                    Select Match
                </h2>

                <p class="text-sm text-muted-foreground">
                    Select a match to view its results.
                </p>

            </x-ui.card-header>


            <x-ui.card-content>

                <form method="GET" action="{{ route('result.index') }}">

                    <select name="match" onchange="this.form.submit()"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring sm:max-w-lg">

                        <option value="">
                            Select a match
                        </option>


                        @foreach ($matches as $item)
                            <option value="{{ $item->id }}" @selected($match?->id === $item->id)>
                                {{ $item->name }}
                                — {{ $item->competition?->name ?? 'No Competition' }}
                            </option>
                        @endforeach

                    </select>

                </form>

            </x-ui.card-content>

        </x-ui.card>


        @if ($match)

            {{-- =====================================================
                MATCH INFORMATION
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-content class="p-6">

                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                        {{-- Match --}}
                        <div class="flex items-start gap-4">

                            <div class="flex size-12 shrink-0 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="trophy" class="size-5 text-muted-foreground"></i>

                            </div>


                            <div>

                                <div class="flex flex-wrap items-center gap-2">

                                    <h2 class="text-lg font-semibold">
                                        {{ $match->name }}
                                    </h2>


                                    @php

                                        $statusVariant = match ($match->status) {
                                            'scheduled' => 'secondary',
                                            'ongoing' => 'success',
                                            'completed' => 'default',
                                            'cancelled' => 'destructive',
                                            default => 'secondary',
                                        };

                                    @endphp


                                    <x-ui.badge :variant="$statusVariant">
                                        {{ ucfirst($match->status) }}
                                    </x-ui.badge>

                                </div>


                                <p class="mt-1 text-sm text-muted-foreground">
                                    {{ $match->competition?->name ?? 'No competition' }}
                                </p>


                                <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2 text-sm text-muted-foreground">

                                    @if ($match->scheduled_at)
                                        <span class="flex items-center gap-2">

                                            <i data-lucide="calendar" class="size-4"></i>

                                            {{ $match->scheduled_at->format('d F Y, H:i') }}

                                        </span>
                                    @endif


                                    @if ($match->location)
                                        <span class="flex items-center gap-2">

                                            <i data-lucide="map-pin" class="size-4"></i>

                                            {{ $match->location }}

                                        </span>
                                    @endif


                                    @if ($match->setting?->distance)
                                        <span class="flex items-center gap-2">

                                            <i data-lucide="ruler" class="size-4"></i>

                                            {{ $match->setting->distance }} m

                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Actions --}}
                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('scoring.index', [
                                    'match' => $match->id,
                                ]) }}">

                                <x-ui.button type="button" variant="outline">

                                    <i data-lucide="clipboard-pen" class="size-4"></i>

                                    Scoring

                                </x-ui.button>

                            </a>

                        </div>

                    </div>

                </x-ui.card-content>

            </x-ui.card>


            {{-- =====================================================
                SUMMARY
            ====================================================== --}}

            @php

                $totalParticipants = $participants->count();

                $totalScore = $participants->sum('total_score');

                $completedParticipants = $participants
                    ->filter(fn($participant) => $participant->total_arrows > 0)
                    ->count();

                $highestScore = $participants->max('total_score') ?? 0;

            @endphp


            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

                {{-- Participants --}}
                <x-ui.card>

                    <x-ui.card-content class="p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Participants
                                </p>

                                <p class="mt-1 text-2xl font-semibold">
                                    {{ $totalParticipants }}
                                </p>

                            </div>


                            <div class="flex size-10 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="users" class="size-5 text-muted-foreground"></i>

                            </div>

                        </div>

                    </x-ui.card-content>

                </x-ui.card>


                {{-- Completed --}}
                <x-ui.card>

                    <x-ui.card-content class="p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Scored
                                </p>

                                <p class="mt-1 text-2xl font-semibold">
                                    {{ $completedParticipants }}
                                </p>

                            </div>


                            <div class="flex size-10 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="check-circle-2" class="size-5 text-muted-foreground"></i>

                            </div>

                        </div>

                    </x-ui.card-content>

                </x-ui.card>


                {{-- Highest --}}
                <x-ui.card>

                    <x-ui.card-content class="p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Highest Score
                                </p>

                                <p class="mt-1 text-2xl font-semibold">
                                    {{ $highestScore }}
                                </p>

                            </div>


                            <div class="flex size-10 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="award" class="size-5 text-muted-foreground"></i>

                            </div>

                        </div>

                    </x-ui.card-content>

                </x-ui.card>


                {{-- Total --}}
                <x-ui.card>

                    <x-ui.card-content class="p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Total Score
                                </p>

                                <p class="mt-1 text-2xl font-semibold">
                                    {{ $totalScore }}
                                </p>

                            </div>


                            <div class="flex size-10 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="bar-chart-3" class="size-5 text-muted-foreground"></i>

                            </div>

                        </div>

                    </x-ui.card-content>

                </x-ui.card>

            </div>


            {{-- =====================================================
                RESULT TABLE
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-header>

                    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <h2 class="text-base font-semibold">
                                Final Results
                            </h2>

                            <p class="text-sm text-muted-foreground">
                                Participant ranking based on total score.
                            </p>

                        </div>


                        <x-ui.badge variant="secondary">

                            {{ $participants->count() }}
                            Participants

                        </x-ui.badge>

                    </div>

                </x-ui.card-header>


                <x-ui.card-content class="p-0">

                    @if ($participants->isNotEmpty())

                        <div class="overflow-x-auto">

                            <table class="w-full text-sm">

                                <thead>

                                    <tr class="border-y bg-muted/30">

                                        <th class="w-20 px-6 py-3 text-center font-medium text-muted-foreground">
                                            Rank
                                        </th>

                                        <th class="px-6 py-3 text-left font-medium text-muted-foreground">
                                            Participant
                                        </th>

                                        <th class="px-6 py-3 text-center font-medium text-muted-foreground">
                                            Lane
                                        </th>

                                        <th class="px-6 py-3 text-center font-medium text-muted-foreground">
                                            Arrows
                                        </th>

                                        <th class="px-6 py-3 text-right font-medium text-muted-foreground">
                                            Total Score
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach ($participants as $participant)
                                        <tr class="border-b last:border-0 transition-colors hover:bg-muted/20">

                                            {{-- Rank --}}
                                            <td class="px-6 py-4 text-center">

                                                @if ($participant->rank === 1)
                                                    <div class="flex justify-center">

                                                        <div
                                                            class="flex size-9 items-center justify-center rounded-full bg-muted font-semibold">

                                                            1

                                                        </div>

                                                    </div>
                                                @elseif ($participant->rank === 2)
                                                    <div class="flex justify-center">

                                                        <div
                                                            class="flex size-9 items-center justify-center rounded-full bg-muted font-semibold">

                                                            2

                                                        </div>

                                                    </div>
                                                @elseif ($participant->rank === 3)
                                                    <div class="flex justify-center">

                                                        <div
                                                            class="flex size-9 items-center justify-center rounded-full bg-muted font-semibold">

                                                            3

                                                        </div>

                                                    </div>
                                                @else
                                                    <span class="font-medium text-muted-foreground">
                                                        {{ $participant->rank }}
                                                    </span>
                                                @endif

                                            </td>


                                            {{-- Participant --}}
                                            <td class="px-6 py-4">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="flex size-10 shrink-0 items-center justify-center rounded-full bg-muted font-medium">

                                                        {{ strtoupper(substr($participant->name, 0, 1)) }}

                                                    </div>


                                                    <div class="min-w-0">

                                                        <p class="truncate font-medium">
                                                            {{ $participant->name }}
                                                        </p>

                                                        <p class="mt-0.5 text-xs text-muted-foreground">
                                                            {{ $participant->participant_number }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- Lane --}}
                                            <td class="px-6 py-4 text-center">

                                                @if ($participant->pivot?->lane)
                                                    <x-ui.badge variant="secondary">

                                                        Lane {{ $participant->pivot->lane }}

                                                    </x-ui.badge>
                                                @else
                                                    <span class="text-muted-foreground">
                                                        —
                                                    </span>
                                                @endif

                                            </td>


                                            {{-- Arrows --}}
                                            <td class="px-6 py-4 text-center">

                                                <span class="text-muted-foreground">
                                                    {{ $participant->total_arrows }}
                                                </span>

                                            </td>


                                            {{-- Score --}}
                                            <td class="px-6 py-4 text-right">

                                                <span class="text-lg font-semibold">
                                                    {{ $participant->total_score }}
                                                </span>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

                            <div class="mb-5 flex size-14 items-center justify-center rounded-full bg-muted">

                                <i data-lucide="bar-chart-3" class="size-6 text-muted-foreground"></i>

                            </div>


                            <h3 class="text-lg font-semibold">
                                No Results
                            </h3>


                            <p class="mt-1 max-w-md text-sm text-muted-foreground">
                                There are no participants or scores available
                                for this match yet.
                            </p>


                            <a href="{{ route('scoring.index', [
                                'match' => $match->id,
                            ]) }}"
                                class="mt-5">

                                <x-ui.button type="button">

                                    <i data-lucide="clipboard-pen" class="size-4"></i>

                                    Go to Scoring

                                </x-ui.button>

                            </a>

                        </div>

                    @endif

                </x-ui.card-content>

            </x-ui.card>
        @else
            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-content class="flex flex-col items-center justify-center py-20 text-center">

                    <div class="mb-5 flex size-14 items-center justify-center rounded-full bg-muted">

                        <i data-lucide="trophy" class="size-6 text-muted-foreground"></i>

                    </div>


                    <h2 class="text-lg font-semibold">
                        Select a Match
                    </h2>


                    <p class="mt-1 max-w-md text-sm text-muted-foreground">
                        Select a match above to view participant rankings
                        and scoring results.
                    </p>

                </x-ui.card-content>

            </x-ui.card>

        @endif

    </div>

@endsection
