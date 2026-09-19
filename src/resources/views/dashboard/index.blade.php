@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="space-y-8">

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm text-muted-foreground">
                    Welcome back,
                </p>

                <h1 class="mt-1 text-2xl font-semibold tracking-tight">
                    {{ auth()->user()->name }}
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Overview of your archery scoring system.
                </p>
            </div>

            <div class="flex items-center gap-2">

                @can('participant.create')
                    <a href="{{ route('partisipan.create') }}"
                        class="inline-flex items-center gap-2 rounded-md border bg-background px-4 py-2 text-sm font-medium transition hover:bg-muted">
                        <i data-lucide="user-plus" class="size-4"></i>
                        Add Participant
                    </a>
                @endcan

                @can('match.create')
                    <a href="{{ route('match.create') }}"
                        class="inline-flex items-center gap-2 rounded-md bg-foreground px-4 py-2 text-sm font-medium text-background transition-opacity hover:opacity-90">
                        <i data-lucide="plus" class="size-4"></i>
                        Create Match
                    </a>
                @endcan

            </div>

        </div>


        {{-- =========================================================
            STATISTICS
        ========================================================== --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Participants --}}
            <div class="rounded-xl border bg-card p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Participants
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-tight">
                            {{ number_format($statistics['participants']) }}
                        </p>
                    </div>

                    <div class="rounded-md bg-muted p-2">
                        <i data-lucide="users" class="size-4"></i>
                    </div>

                </div>

                <p class="mt-2 text-xs text-muted-foreground">
                    Registered participants
                </p>

            </div>


            {{-- Competitions --}}
            <div class="rounded-xl border bg-card p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Competitions
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-tight">
                            {{ number_format($statistics['competitions']) }}
                        </p>
                    </div>

                    <div class="rounded-md bg-muted p-2">
                        <i data-lucide="trophy" class="size-4"></i>
                    </div>

                </div>

                <p class="mt-2 text-xs text-muted-foreground">
                    Total competitions
                </p>

            </div>


            {{-- Matches --}}
            <div class="rounded-xl border bg-card p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Matches
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-tight">
                            {{ number_format($statistics['matches']) }}
                        </p>
                    </div>

                    <div class="rounded-md bg-muted p-2">
                        <i data-lucide="swords" class="size-4"></i>
                    </div>

                </div>

                <p class="mt-2 text-xs text-muted-foreground">
                    Total matches
                </p>

            </div>


            {{-- Scores --}}
            <div class="rounded-xl border bg-card p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-muted-foreground">
                            Scores
                        </p>

                        <p class="mt-3 text-3xl font-semibold tracking-tight">
                            {{ number_format($statistics['scores']) }}
                        </p>
                    </div>

                    <div class="rounded-md bg-muted p-2">
                        <i data-lucide="target" class="size-4"></i>
                    </div>

                </div>

                <p class="mt-2 text-xs text-muted-foreground">
                    Scores recorded
                </p>

            </div>

        </div>


        {{-- =========================================================
            MAIN CONTENT
        ========================================================== --}}
        <div class="grid gap-6 lg:grid-cols-3">

            {{-- =====================================================
                UPCOMING MATCHES
            ====================================================== --}}
            <div class="rounded-xl border bg-card shadow-sm lg:col-span-2">

                <div class="flex items-center justify-between border-b px-6 py-4">

                    <div>
                        <h2 class="text-sm font-semibold">
                            Upcoming Matches
                        </h2>

                        <p class="mt-1 text-xs text-muted-foreground">
                            Your next scheduled matches.
                        </p>
                    </div>

                    @can('match.view')
                        <a href="{{ route('match.index') }}"
                            class="text-xs font-medium text-muted-foreground transition hover:text-foreground">
                            View all
                        </a>
                    @endcan

                </div>


                @if ($upcomingMatches->isNotEmpty())

                    <div class="divide-y">

                        @foreach ($upcomingMatches as $match)
                            <div class="p-5 transition hover:bg-muted/30">

                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                    {{-- Match Info --}}
                                    <div class="min-w-0">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <h3 class="font-medium">
                                                {{ $match->name }}
                                            </h3>

                                            @php
                                                $statusClass = match ($match->status) {
                                                    'scheduled' => 'bg-muted text-foreground',
                                                    'ongoing'
                                                        => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                                    'completed' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                                                    'cancelled' => 'bg-red-500/10 text-red-600 dark:text-red-400',
                                                    default => 'bg-muted text-foreground',
                                                };
                                            @endphp

                                            <span
                                                class="rounded-full px-2 py-0.5 text-[11px] font-medium {{ $statusClass }}">
                                                {{ ucfirst($match->status) }}
                                            </span>

                                        </div>

                                        <p class="mt-1 text-sm text-muted-foreground">
                                            {{ $match->competition?->name ?? 'No competition' }}
                                        </p>


                                        {{-- Metadata --}}
                                        <div class="mt-3 flex flex-wrap gap-x-4 gap-y-2 text-xs text-muted-foreground">

                                            @if ($match->scheduled_at)
                                                <span class="inline-flex items-center gap-1.5">
                                                    <i data-lucide="calendar" class="size-3.5"></i>
                                                    {{ $match->scheduled_at->format('d M Y, H:i') }}
                                                </span>
                                            @endif


                                            @if ($match->location)
                                                <span class="inline-flex items-center gap-1.5">
                                                    <i data-lucide="map-pin" class="size-3.5"></i>
                                                    {{ $match->location }}
                                                </span>
                                            @endif


                                            @if ($match->setting?->distance)
                                                <span class="inline-flex items-center gap-1.5">
                                                    <i data-lucide="ruler" class="size-3.5"></i>
                                                    {{ $match->setting->distance }} m
                                                </span>
                                            @endif


                                            <span class="inline-flex items-center gap-1.5">
                                                <i data-lucide="users" class="size-3.5"></i>
                                                {{ $match->participants->count() }} participants
                                            </span>

                                        </div>

                                    </div>


                                    {{-- Action --}}
                                    <div class="shrink-0">

                                        @can('match.view')
                                            <a href="{{ route('match.show', $match) }}"
                                                class="inline-flex items-center gap-2 rounded-md border px-3 py-2 text-xs font-medium transition hover:bg-muted">
                                                View
                                                <i data-lucide="arrow-up-right" class="size-3.5"></i>
                                            </a>
                                        @endcan

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="flex min-h-72 items-center justify-center px-6">

                        <div class="text-center">

                            <div class="mx-auto flex size-12 items-center justify-center rounded-lg bg-muted">
                                <i data-lucide="calendar-x" class="size-5 text-muted-foreground"></i>
                            </div>

                            <p class="mt-3 text-sm font-medium">
                                No upcoming matches
                            </p>

                            <p class="mt-1 text-xs text-muted-foreground">
                                Scheduled matches will appear here.
                            </p>

                            @can('match.create')
                                <a href="{{ route('match.create') }}"
                                    class="mt-4 inline-flex items-center gap-2 rounded-md border px-3 py-2 text-xs font-medium transition hover:bg-muted">
                                    <i data-lucide="plus" class="size-3.5"></i>
                                    Create Match
                                </a>
                            @endcan

                        </div>

                    </div>

                @endif

            </div>


            {{-- =====================================================
                ONGOING MATCHES
            ====================================================== --}}
            <div class="rounded-xl border bg-card shadow-sm">

                <div class="flex items-center justify-between border-b px-6 py-4">

                    <div>
                        <h2 class="text-sm font-semibold">
                            Ongoing Matches
                        </h2>

                        <p class="mt-1 text-xs text-muted-foreground">
                            Matches currently in progress.
                        </p>
                    </div>

                </div>


                @if ($ongoingMatches->isNotEmpty())

                    <div class="divide-y">

                        @foreach ($ongoingMatches as $match)
                            <div class="p-4">

                                <div class="flex items-start gap-3">

                                    <div
                                        class="flex size-9 shrink-0 items-center justify-center rounded-md bg-emerald-500/10">
                                        <i data-lucide="target" class="size-4 text-emerald-600 dark:text-emerald-400"></i>
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <div class="flex items-center justify-between gap-2">

                                            <p class="truncate text-sm font-medium">
                                                {{ $match->name }}
                                            </p>

                                            <span class="size-2 shrink-0 rounded-full bg-emerald-500"></span>

                                        </div>

                                        <p class="mt-1 truncate text-xs text-muted-foreground">
                                            {{ $match->competition?->name ?? 'No competition' }}
                                        </p>

                                        <div class="mt-2 flex items-center gap-3 text-[11px] text-muted-foreground">

                                            <span class="inline-flex items-center gap-1">
                                                <i data-lucide="users" class="size-3"></i>
                                                {{ $match->participants->count() }}
                                            </span>

                                            @if ($match->setting?->distance)
                                                <span class="inline-flex items-center gap-1">
                                                    <i data-lucide="ruler" class="size-3"></i>
                                                    {{ $match->setting->distance }}m
                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>

                    @can('scoring.view')
                        <div class="border-t p-4">
                            <a href="{{ route('scoring.index') }}"
                                class="flex w-full items-center justify-center gap-2 rounded-md bg-foreground px-3 py-2 text-xs font-medium text-background transition-opacity hover:opacity-90">
                                <i data-lucide="target" class="size-3.5"></i>
                                Open Scoring
                            </a>
                        </div>
                    @endcan
                @else
                    <div class="flex min-h-64 items-center justify-center px-6">

                        <div class="text-center">

                            <div class="mx-auto flex size-10 items-center justify-center rounded-lg bg-muted">
                                <i data-lucide="circle-pause" class="size-4 text-muted-foreground"></i>
                            </div>

                            <p class="mt-3 text-sm font-medium">
                                No ongoing matches
                            </p>

                            <p class="mt-1 text-xs text-muted-foreground">
                                No match is currently in progress.
                            </p>

                        </div>

                    </div>

                @endif

            </div>

        </div>


        {{-- =========================================================
            RECENT MATCHES + QUICK ACTIONS
        ========================================================== --}}
        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Recent Matches --}}
            <div class="rounded-xl border bg-card shadow-sm lg:col-span-2">

                <div class="flex items-center justify-between border-b px-6 py-4">

                    <div>
                        <h2 class="text-sm font-semibold">
                            Recent Matches
                        </h2>

                        <p class="mt-1 text-xs text-muted-foreground">
                            Latest matches in the system.
                        </p>
                    </div>

                    @can('match.view')
                        <a href="{{ route('match.index') }}"
                            class="text-xs font-medium text-muted-foreground transition hover:text-foreground">
                            View all
                        </a>
                    @endcan

                </div>


                <div class="divide-y">

                    @forelse ($recentMatches as $match)
                        <div class="flex items-center justify-between gap-4 p-5">

                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex size-9 shrink-0 items-center justify-center rounded-md bg-muted">
                                    <i data-lucide="swords" class="size-4"></i>
                                </div>

                                <div class="min-w-0">

                                    <p class="truncate text-sm font-medium">
                                        {{ $match->name }}
                                    </p>

                                    <p class="mt-1 truncate text-xs text-muted-foreground">
                                        {{ $match->competition?->name ?? 'No competition' }}
                                    </p>

                                </div>

                            </div>


                            <div class="shrink-0 text-right">

                                <p class="text-xs font-medium">
                                    {{ ucfirst($match->status) }}
                                </p>

                                @if ($match->scheduled_at)
                                    <p class="mt-1 text-[11px] text-muted-foreground">
                                        {{ $match->scheduled_at->format('d M Y') }}
                                    </p>
                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="flex min-h-40 items-center justify-center px-6">

                            <div class="text-center">

                                <p class="text-sm font-medium">
                                    No matches yet
                                </p>

                                <p class="mt-1 text-xs text-muted-foreground">
                                    Match data will appear here.

                                </p>

                            </div>

                        </div>
                    @endforelse

                </div>

            </div>


            {{-- =====================================================
                QUICK ACTIONS
            ====================================================== --}}
            <div class="rounded-xl border bg-card shadow-sm">

                <div class="border-b px-6 py-4">

                    <h2 class="text-sm font-semibold">
                        Quick Actions
                    </h2>

                    <p class="mt-1 text-xs text-muted-foreground">
                        Frequently used actions.
                    </p>

                </div>


                <div class="space-y-2 p-4">

                    @can('participant.create')
                        <a href="{{ route('partisipan.create') }}"
                            class="flex items-center gap-3 rounded-lg border p-3 transition-colors hover:bg-muted">
                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">
                                <i data-lucide="user-plus" class="size-4"></i>
                            </div>

                            <div>
                                <p class="text-sm font-medium">
                                    Add Participant
                                </p>

                                <p class="text-xs text-muted-foreground">
                                    Register a new participant
                                </p>
                            </div>
                        </a>
                    @endcan


                    @can('competition.create')
                        <a href="{{ route('competition.create') }}"
                            class="flex items-center gap-3 rounded-lg border p-3 transition-colors hover:bg-muted">
                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">
                                <i data-lucide="trophy" class="size-4"></i>
                            </div>

                            <div>
                                <p class="text-sm font-medium">
                                    Create Competition
                                </p>

                                <p class="text-xs text-muted-foreground">
                                    Set up a new competition
                                </p>
                            </div>
                        </a>
                    @endcan


                    @can('match.create')
                        <a href="{{ route('match.create') }}"
                            class="flex items-center gap-3 rounded-lg border p-3 transition-colors hover:bg-muted">
                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">
                                <i data-lucide="calendar-plus" class="size-4"></i>
                            </div>

                            <div>
                                <p class="text-sm font-medium">
                                    Create Match
                                </p>

                                <p class="text-xs text-muted-foreground">
                                    Schedule a new match
                                </p>
                            </div>
                        </a>
                    @endcan


                    @can('scoring.view')
                        <a href="{{ route('scoring.index') }}"
                            class="flex items-center gap-3 rounded-lg border p-3 transition-colors hover:bg-muted">
                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">
                                <i data-lucide="target" class="size-4"></i>
                            </div>

                            <div>
                                <p class="text-sm font-medium">
                                    Open Scoring
                                </p>

                                <p class="text-xs text-muted-foreground">
                                    Record participant scores
                                </p>
                            </div>
                        </a>
                    @endcan


                    @can('result.view')
                        <a href="{{ route('result.index') }}"
                            class="flex items-center gap-3 rounded-lg border p-3 transition-colors hover:bg-muted">
                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">
                                <i data-lucide="bar-chart-3" class="size-4"></i>
                            </div>

                            <div>
                                <p class="text-sm font-medium">
                                    View Results
                                </p>

                                <p class="text-xs text-muted-foreground">
                                    Review match results
                                </p>
                            </div>
                        </a>
                    @endcan

                </div>

            </div>

        </div>

    </div>

@endsection
