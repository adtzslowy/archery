@extends('layouts.app')

@section('title', 'Scoring')

@section('content')

    <div class="space-y-6">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div>
            <h1 class="text-2xl font-semibold tracking-tight">
                Scoring
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                Select a match and participant to enter scores.
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
                    Select a match to manage participant scoring.
                </p>

            </x-ui.card-header>


            <x-ui.card-content>

                <form
                    method="GET"
                    action="{{ route('scoring.index') }}"
                >

                    <select
                        name="match"
                        onchange="this.form.submit()"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring sm:max-w-md"
                    >

                        <option value="">
                            Select a match
                        </option>

                        @foreach ($matches as $item)

                            <option
                                value="{{ $item->id }}"
                                @selected($match?->id === $item->id)
                            >
                                {{ $item->name }}
                                — {{ $item->competition?->name ?? 'No Competition' }}
                            </option>

                        @endforeach

                    </select>

                </form>

            </x-ui.card-content>

        </x-ui.card>


        @if ($match)

            @php

                $ends = $match->setting?->ends ?? 1;

                $arrowsPerEnd = $match->setting?->arrows_per_end ?? 6;

            @endphp


            {{-- =====================================================
                MATCH INFORMATION
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-content class="p-6">

                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                        {{-- Match Info --}}
                        <div class="flex items-start gap-4">

                            <div class="flex size-12 shrink-0 items-center justify-center rounded-lg bg-muted">

                                <i
                                    data-lucide="target"
                                    class="size-5 text-muted-foreground"
                                ></i>

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

                                            <i
                                                data-lucide="calendar"
                                                class="size-4"
                                            ></i>

                                            {{ $match->scheduled_at->format('d F Y, H:i') }}

                                        </span>

                                    @endif


                                    @if ($match->location)

                                        <span class="flex items-center gap-2">

                                            <i
                                                data-lucide="map-pin"
                                                class="size-4"
                                            ></i>

                                            {{ $match->location }}

                                        </span>

                                    @endif


                                    @if ($match->setting?->distance)

                                        <span class="flex items-center gap-2">

                                            <i
                                                data-lucide="ruler"
                                                class="size-4"
                                            ></i>

                                            {{ $match->setting->distance }} m

                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Match Setup --}}
                        <div>

                            <a
                                href="{{ route('match-setup.index', ['match' => $match->id]) }}"
                            >

                                <x-ui.button
                                    type="button"
                                    variant="outline"
                                >

                                    <i
                                        data-lucide="settings"
                                        class="size-4"
                                    ></i>

                                    Match Setup

                                </x-ui.button>

                            </a>

                        </div>

                    </div>

                </x-ui.card-content>

            </x-ui.card>


            {{-- =====================================================
                MATCH OVERVIEW
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-content class="p-0">

                    <div class="grid divide-y sm:grid-cols-3 sm:divide-x sm:divide-y-0">

                        {{-- Participants --}}
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-muted">

                                <i
                                    data-lucide="users"
                                    class="size-5 text-muted-foreground"
                                ></i>

                            </div>


                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Participants
                                </p>

                                <p class="text-xl font-semibold">
                                    {{ $participants->count() }}
                                </p>

                            </div>

                        </div>


                        {{-- Ends --}}
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-muted">

                                <i
                                    data-lucide="layers"
                                    class="size-5 text-muted-foreground"
                                ></i>

                            </div>


                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Ends
                                </p>

                                <p class="text-xl font-semibold">
                                    {{ $ends }}
                                </p>

                            </div>

                        </div>


                        {{-- Arrows --}}
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-muted">

                                <i
                                    data-lucide="arrow-up-right"
                                    class="size-5 text-muted-foreground"
                                ></i>

                            </div>


                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Arrows / End
                                </p>

                                <p class="text-xl font-semibold">
                                    {{ $arrowsPerEnd }}
                                </p>

                            </div>

                        </div>

                    </div>

                </x-ui.card-content>

            </x-ui.card>


            {{-- =====================================================
                PARTICIPANTS
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-header>

                    <div>

                        <h2 class="text-base font-semibold">
                            Participants
                        </h2>

                        <p class="text-sm text-muted-foreground">
                            Select a participant to enter their scores.
                        </p>

                    </div>

                </x-ui.card-header>


                <x-ui.card-content class="p-0">

                    @forelse ($participants as $participant)

                        @php

                            $participantTotal = $participant->scores
                                ->where('match_id', $match->id)
                                ->sum('point');

                        @endphp


                        <div
                            class="flex flex-col gap-4 border-t px-6 py-5 transition-colors hover:bg-muted/20 sm:flex-row sm:items-center sm:justify-between"
                        >

                            {{-- Participant --}}
                            <div class="flex items-center gap-4">

                                <div class="flex size-11 shrink-0 items-center justify-center rounded-full bg-muted font-medium">

                                    {{ strtoupper(substr($participant->name, 0, 1)) }}

                                </div>


                                <div>

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h3 class="font-semibold">
                                            {{ $participant->name }}
                                        </h3>


                                        @if ($participant->pivot->lane)

                                            <x-ui.badge variant="secondary">

                                                Lane {{ $participant->pivot->lane }}

                                            </x-ui.badge>

                                        @endif

                                    </div>


                                    <div class="mt-1 flex flex-wrap items-center gap-3 text-sm text-muted-foreground">

                                        <span>
                                            {{ $participant->participant_number }}
                                        </span>

                                        <span>
                                            {{ ucfirst($participant->gender) }}
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- Score + Action --}}
                            <div class="flex items-center justify-between gap-6 sm:justify-end">

                                <div class="text-left sm:text-right">

                                    <p class="text-xs text-muted-foreground">
                                        Total Score
                                    </p>

                                    <p class="text-lg font-semibold">
                                        {{ $participantTotal }}
                                    </p>

                                </div>


                                <a
                                    href="{{ route('scoring.participant', [
                                        'match' => $match->id,
                                        'participant' => $participant->id,
                                    ]) }}"
                                >

                                    <x-ui.button type="button">

                                        <i
                                            data-lucide="pencil"
                                            class="size-4"
                                        ></i>

                                        Masukkan Skor

                                    </x-ui.button>

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

                            <div class="mb-5 flex size-14 items-center justify-center rounded-full bg-muted">

                                <i
                                    data-lucide="users"
                                    class="size-6 text-muted-foreground"
                                ></i>

                            </div>


                            <h3 class="text-lg font-semibold">
                                No Participants
                            </h3>


                            <p class="mt-1 max-w-md text-sm text-muted-foreground">
                                This match has no participants assigned yet.
                                Add participants through Match Setup first.
                            </p>


                            <a
                                href="{{ route('match-setup.index', ['match' => $match->id]) }}"
                                class="mt-5"
                            >

                                <x-ui.button type="button">

                                    <i
                                        data-lucide="users"
                                        class="size-4"
                                    ></i>

                                    Match Setup

                                </x-ui.button>

                            </a>

                        </div>

                    @endforelse

                </x-ui.card-content>

            </x-ui.card>


        @else

            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-content class="flex flex-col items-center justify-center py-20 text-center">

                    <div class="mb-5 flex size-14 items-center justify-center rounded-full bg-muted">

                        <i
                            data-lucide="target"
                            class="size-6 text-muted-foreground"
                        ></i>

                    </div>


                    <h2 class="text-lg font-semibold">
                        Select a Match
                    </h2>


                    <p class="mt-1 max-w-md text-sm text-muted-foreground">
                        Select a match above to view its participants.
                    </p>

                </x-ui.card-content>

            </x-ui.card>

        @endif

    </div>

@endsection