@extends('layouts.app')

@section('title', 'Input Score')

@section('content')

    @php

        $ends = $match->setting?->ends ?? 1;

        $arrowsPerEnd = $match->setting?->arrows_per_end ?? 6;

        $participantScores = $participant->scores->where('match_id', $match->id);

        $participantTotal = $participantScores->sum('point');

    @endphp


    <div class="space-y-6">

        {{-- =========================================================
            HEADER
        ========================================================== --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="flex items-center gap-2 text-sm text-muted-foreground">

                    <a href="{{ route('scoring.index', ['match' => $match->id]) }}" class="hover:text-foreground">
                        Scoring
                    </a>

                    <span>/</span>

                    <span>
                        {{ $participant->name }}
                    </span>

                </div>


                <h1 class="mt-2 text-2xl font-semibold tracking-tight">
                    Input Score
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Enter scores for each end and shot.
                </p>

            </div>


            <a href="{{ route('scoring.index', ['match' => $match->id]) }}">

                <x-ui.button type="button" variant="outline">

                    <i data-lucide="arrow-left" class="size-4"></i>

                    Back to Participants

                </x-ui.button>

            </a>

        </div>


        {{-- =========================================================
            PARTICIPANT INFORMATION
        ========================================================== --}}

        <x-ui.card>

            <x-ui.card-content class="p-6">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-4">

                        <div
                            class="flex size-14 shrink-0 items-center justify-center rounded-full bg-muted text-lg font-semibold">

                            {{ strtoupper(substr($participant->name, 0, 1)) }}

                        </div>


                        <div>

                            <div class="flex flex-wrap items-center gap-2">

                                <h2 class="text-lg font-semibold">
                                    {{ $participant->name }}
                                </h2>


                                @if ($participant->pivot?->lane)
                                    <x-ui.badge variant="secondary">

                                        Lane {{ $participant->pivot->lane }}

                                    </x-ui.badge>
                                @endif

                            </div>


                            <p class="mt-1 text-sm text-muted-foreground">

                                {{ $participant->participant_number }}

                                <span class="mx-1">•</span>

                                {{ ucfirst($participant->gender) }}

                            </p>

                        </div>

                    </div>


                    {{-- Total --}}
                    <div class="border-t pt-4 sm:border-l sm:border-t-0 sm:pl-6 sm:pt-0">

                        <p class="text-sm text-muted-foreground">
                            Total Score
                        </p>

                        <p class="text-3xl font-semibold">
                            {{ $participantTotal }}
                        </p>

                    </div>

                </div>

            </x-ui.card-content>

        </x-ui.card>


        {{-- =========================================================
            MATCH INFO
        ========================================================== --}}

        <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-muted-foreground">

            <span class="flex items-center gap-2">

                <i data-lucide="target" class="size-4"></i>

                {{ $match->name }}

            </span>


            <span class="flex items-center gap-2">

                <i data-lucide="layers" class="size-4"></i>

                {{ $ends }} Ends

            </span>


            <span class="flex items-center gap-2">

                <i data-lucide="arrow-up-right" class="size-4"></i>

                {{ $arrowsPerEnd }} Arrows / End

            </span>


            @if ($match->setting?->distance)
                <span class="flex items-center gap-2">

                    <i data-lucide="ruler" class="size-4"></i>

                    {{ $match->setting->distance }} m

                </span>
            @endif

        </div>


        {{-- =========================================================
            SCORE INPUT
        ========================================================== --}}

        <div class="space-y-4">

            @for ($end = 1; $end <= $ends; $end++)

                @php

                    $endScores = $participantScores->where('end', $end);

                    $endTotal = $endScores->sum('point');

                @endphp


                <x-ui.card>

                    {{-- End Header --}}
                    <x-ui.card-header>

                        <div class="flex items-center justify-between gap-4">

                            <div class="flex items-center gap-3">

                                <div class="flex size-9 items-center justify-center rounded-lg bg-muted font-semibold">

                                    {{ $end }}

                                </div>


                                <div>

                                    <h2 class="font-semibold">
                                        End {{ $end }}
                                    </h2>

                                    <p class="text-sm text-muted-foreground">
                                        {{ $arrowsPerEnd }} arrows
                                    </p>

                                </div>

                            </div>


                            <div class="text-right">

                                <p class="text-xs text-muted-foreground">
                                    End Total
                                </p>

                                <p class="text-xl font-semibold">
                                    {{ $endTotal }}
                                </p>

                            </div>

                        </div>

                    </x-ui.card-header>


                    <x-ui.card-content>

                        <form method="POST" action="{{ route('scoring.store', $match) }}">

                            @csrf


                            <input type="hidden" name="participant_id" value="{{ $participant->id }}">


                            <input type="hidden" name="end" value="{{ $end }}">


                            {{-- Shots --}}
                            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-6">

                                @for ($shot = 1; $shot <= $arrowsPerEnd; $shot++)
                                    @php

                                        $score = $endScores->firstWhere('shot_number', $shot);

                                    @endphp


                                    <div class="space-y-2">

                                        <label for="score-{{ $participant->id }}-{{ $end }}-{{ $shot }}"
                                            class="block text-xs font-medium text-muted-foreground">
                                            Shot {{ $shot }}
                                        </label>


                                        <input id="score-{{ $participant->id }}-{{ $end }}-{{ $shot }}"
                                            type="number" name="shots[{{ $shot }}]" min="0" max="10"
                                            value="{{ old('shots.' . $shot, $score?->point) }}"
                                            placeholder="0"
                                            class="h-11 w-full rounded-md border border-input bg-background px-3 py-2 text-center text-base font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">

                                    </div>
                                @endfor

                            </div>


                            {{-- Validation Error --}}
                            @error('shots')
                                <p class="mt-3 text-sm text-destructive">
                                    {{ $message }}
                                </p>
                            @enderror


                            {{-- Save --}}
                            <div class="mt-6 flex justify-end">

                                <x-ui.button type="submit">

                                    <i data-lucide="save" class="size-4"></i>

                                    Save End {{ $end }}

                                </x-ui.button>

                            </div>

                        </form>

                    </x-ui.card-content>

                </x-ui.card>

            @endfor

        </div>


        {{-- =========================================================
            FOOTER ACTION
        ========================================================== --}}

        <div class="flex justify-start">

            <a href="{{ route('scoring.index', ['match' => $match->id]) }}">

                <x-ui.button type="button" variant="ghost">

                    <i data-lucide="arrow-left" class="size-4"></i>

                    Back to Participants

                </x-ui.button>

            </a>

        </div>

    </div>

@endsection
