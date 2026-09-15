@extends('layouts.app')

@section('title', 'Match Setup')

@section('content')

    <div class="space-y-6">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 text-sm text-muted-foreground">

                    <a href="{{ route('match.index') }}" class="transition-colors hover:text-foreground">
                        Matches
                    </a>

                    <i data-lucide="chevron-right" class="size-4"></i>

                    <span>
                        Match Setup
                    </span>

                </div>

                {{-- Title --}}
                <h1 class="mt-2 text-2xl font-semibold tracking-tight">
                    {{ $match->name }}
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Configure participants and scoring settings for this match.
                </p>

            </div>


            {{-- Back --}}
            <a href="{{ route('match.show', $match) }}">

                <x-ui.button type="button" variant="outline">

                    <i data-lucide="arrow-left" class="size-4"></i>

                    Back to Match

                </x-ui.button>

            </a>

        </div>


        {{-- =========================================================
            FLASH MESSAGE
        ========================================================== --}}

        @if (session('success'))
            <div class="flex items-start gap-3 rounded-lg border border-green-500/20 bg-green-500/10 px-4 py-3">

                <i data-lucide="circle-check" class="mt-0.5 size-4 shrink-0 text-green-600"></i>

                <p class="text-sm text-green-700 dark:text-green-400">
                    {{ session('success') }}
                </p>

            </div>
        @endif


        @if (session('error'))
            <div class="flex items-start gap-3 rounded-lg border border-destructive/20 bg-destructive/10 px-4 py-3">

                <i data-lucide="circle-alert" class="mt-0.5 size-4 shrink-0 text-destructive"></i>

                <p class="text-sm text-destructive">
                    {{ session('error') }}
                </p>

            </div>
        @endif


        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}

        @if ($errors->any())

            <div class="rounded-lg border border-destructive/20 bg-destructive/10 px-4 py-3">

                <div class="flex items-start gap-3">

                    <i data-lucide="circle-alert" class="mt-0.5 size-4 shrink-0 text-destructive"></i>

                    <div>

                        <p class="text-sm font-medium text-destructive">
                            Please check the following errors:
                        </p>

                        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-destructive">

                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
            MATCH INFORMATION
        ========================================================== --}}

        <x-ui.card>

            <x-ui.card-header>

                <div>

                    <h2 class="text-base font-semibold">
                        Match Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Basic information about this match.
                    </p>

                </div>

            </x-ui.card-header>


            <x-ui.card-content>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- Competition --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Competition
                        </p>

                        <p class="mt-1 font-medium">
                            {{ $match->competition?->name ?? '-' }}
                        </p>

                    </div>


                    {{-- Match --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Match
                        </p>

                        <p class="mt-1 font-medium">
                            {{ $match->name }}
                        </p>

                    </div>


                    {{-- Schedule --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Scheduled
                        </p>

                        <p class="mt-1 font-medium">
                            {{ $match->scheduled_at?->timezone('Asia/Jakarta')->format('d F Y, H:i') ?? '-' }}
                        </p>

                    </div>


                    {{-- Location --}}
                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Location
                        </p>

                        <p class="mt-1 font-medium">
                            {{ $match->location ?? '-' }}
                        </p>

                    </div>

                </div>

            </x-ui.card-content>

        </x-ui.card>


        {{-- =========================================================
            PARTICIPANTS
        ========================================================== --}}

        <x-ui.card>

            <x-ui.card-header>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h2 class="text-base font-semibold">
                            Participants
                        </h2>

                        <p class="text-sm text-muted-foreground">
                            Assign participants and lanes for this match.
                        </p>

                    </div>


                    {{-- Add Participant --}}
                    <button type="button"
                        onclick="document
                            .getElementById('add-participant-form')
                            .classList.toggle('hidden')">

                        <x-ui.button type="button">

                            <i data-lucide="user-plus" class="size-4"></i>

                            Add Participant

                        </x-ui.button>

                    </button>

                </div>

            </x-ui.card-header>


            <x-ui.card-content class="space-y-6">


                {{-- =====================================================
                    ADD PARTICIPANT FORM
                ====================================================== --}}

                <div id="add-participant-form" class="hidden rounded-lg border bg-muted/20 p-4">

                    <form action="{{ route('match-setup.participants.store', $match) }}" method="POST" class="space-y-4">

                        @csrf


                        <div class="grid gap-4 sm:grid-cols-2">

                            {{-- Participant --}}
                            <div class="space-y-2">

                                <label for="participant_id" class="text-sm font-medium">
                                    Participant
                                </label>

                                <select id="participant_id" name="participant_id"
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm outline-none transition-colors focus:ring-2 focus:ring-ring"
                                    required>

                                    <option value="">
                                        Select participant
                                    </option>

                                    @foreach ($availableParticipants as $participant)
                                        <option value="{{ $participant->id }}" @selected(old('participant_id') == $participant->id)>
                                            {{ $participant->name }}
                                            — {{ $participant->participant_number }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('participant_id')
                                    <p class="text-sm text-destructive">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Lane --}}
                            <div class="space-y-2">

                                <label for="lane" class="text-sm font-medium">
                                    Lane
                                </label>

                                <x-ui.input id="lane" name="lane" type="number" min="1"
                                    value="{{ old('lane') }}" placeholder="1" required />

                                @error('lane')
                                    <p class="text-sm text-destructive">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- Form Actions --}}
                        <div class="flex justify-end gap-2">

                            <button type="button"
                                onclick="document
                                    .getElementById('add-participant-form')
                                    .classList.add('hidden')">

                                <x-ui.button type="button" variant="outline">
                                    Cancel
                                </x-ui.button>

                            </button>


                            <x-ui.button type="submit">

                                <i data-lucide="plus" class="size-4"></i>

                                Add Participant

                            </x-ui.button>

                        </div>

                    </form>

                </div>


                {{-- =====================================================
                    PARTICIPANT TABLE
                ====================================================== --}}

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="border-y bg-muted/40">

                            <tr class="text-left">

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Participant
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Number
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Gender
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Lane
                                </th>

                                <th class="w-24 px-6 py-3 text-right">
                                    <span class="sr-only">
                                        Actions
                                    </span>
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse ($match->participants as $participant)
                                <tr class="transition-colors hover:bg-muted/30">

                                    {{-- Participant --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex size-9 shrink-0 items-center justify-center rounded-full bg-muted text-sm font-medium">
                                                {{ strtoupper(substr($participant->name, 0, 1)) }}
                                            </div>

                                            <div class="min-w-0">

                                                <p class="truncate font-medium">
                                                    {{ $participant->name }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Participant Number --}}
                                    <td class="px-6 py-4 text-muted-foreground">
                                        {{ $participant->participant_number }}
                                    </td>


                                    {{-- Gender --}}
                                    <td class="px-6 py-4 text-muted-foreground">
                                        {{ $participant->gender ?? '-' }}
                                    </td>


                                    {{-- Lane --}}
                                    <td class="px-6 py-4">

                                        @if ($participant->pivot->lane)
                                            <x-ui.badge variant="secondary">

                                                Lane {{ $participant->pivot->lane }}

                                            </x-ui.badge>
                                        @else
                                            <span class="text-muted-foreground">
                                                Not assigned
                                            </span>
                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-4">

                                        <div class="flex justify-end gap-1">

                                            {{-- Edit Lane --}}
                                            <button type="button"
                                                onclick="document
                                                    .getElementById('edit-lane-{{ $participant->id }}')
                                                    .classList.toggle('hidden')"
                                                class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                                                title="Edit lane">

                                                <i data-lucide="pencil" class="size-4"></i>

                                                <span class="sr-only">
                                                    Edit lane
                                                </span>

                                            </button>


                                            {{-- Remove Participant --}}
                                            <form
                                                action="{{ route('match-setup.participants.destroy', [$match, $participant]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Remove this participant from the match?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive"
                                                    title="Remove participant">

                                                    <i data-lucide="trash-2" class="size-4"></i>

                                                    <span class="sr-only">
                                                        Remove participant
                                                    </span>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                                {{-- =================================================
                                    EDIT LANE
                                ================================================== --}}

                                <tr id="edit-lane-{{ $participant->id }}" class="hidden bg-muted/10">

                                    <td colspan="5" class="px-6 py-4">

                                        <form
                                            action="{{ route('match-setup.participants.update', [$match, $participant]) }}"
                                            method="POST" class="flex flex-col gap-3 sm:flex-row sm:items-end">

                                            @csrf
                                            @method('PUT')


                                            <div class="w-full sm:w-48">

                                                <label for="lane-{{ $participant->id }}" class="text-sm font-medium">
                                                    Lane
                                                </label>

                                                <x-ui.input id="lane-{{ $participant->id }}" name="lane"
                                                    type="number" min="1"
                                                    value="{{ $participant->pivot->lane }}" placeholder="Lane"
                                                    required />

                                            </div>


                                            <x-ui.button type="submit">

                                                <i data-lucide="save" class="size-4"></i>

                                                Update Lane

                                            </x-ui.button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="mb-4 flex size-12 items-center justify-center rounded-full bg-muted">

                                                <i data-lucide="users" class="size-5 text-muted-foreground"></i>

                                            </div>

                                            <h3 class="font-medium">
                                                No participants assigned
                                            </h3>

                                            <p class="mt-1 text-sm text-muted-foreground">
                                                Add participants to this match before starting the scoring.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </x-ui.card-content>

        </x-ui.card>


        {{-- =========================================================
            MATCH SETTINGS
        ========================================================== --}}

        <x-ui.card>

            <x-ui.card-header>

                <div>

                    <h2 class="text-base font-semibold">
                        Match Settings
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Configure the scoring rules for this match.
                    </p>

                </div>

            </x-ui.card-header>


            <x-ui.card-content>

                <form action="{{ route('match-setup.settings.update', $match) }}" method="POST" class="space-y-6">

                    @csrf
                    @method('PUT')


                    {{-- =====================================================
                        SETTINGS INPUTS
                    ====================================================== --}}

                    <div class="grid gap-6 sm:grid-cols-3">

                        {{-- Distance --}}
                        <div class="space-y-2">

                            <label for="distance" class="text-sm font-medium">
                                Distance
                            </label>

                            <div class="relative">

                                <x-ui.input id="distance" name="distance" type="number" min="1"
                                    value="{{ old('distance', $match->setting?->distance) }}" placeholder="30"
                                    class="pr-10" />

                                <span
                                    class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-sm text-muted-foreground">
                                    m
                                </span>

                            </div>

                            @error('distance')
                                <p class="text-sm text-destructive">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Number of Ends --}}
                        <div class="space-y-2">

                            <label for="ends" class="text-sm font-medium">
                                Number of Ends
                            </label>

                            <x-ui.input id="ends" name="ends" type="number" min="1"
                                value="{{ old('ends', $match->setting?->ends ?? 6) }}" placeholder="6" required />

                            @error('ends')
                                <p class="text-sm text-destructive">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Arrows per End --}}
                        <div class="space-y-2">

                            <label for="arrows_per_end" class="text-sm font-medium">
                                Arrows per End
                            </label>

                            <x-ui.input id="arrows_per_end" name="arrows_per_end" type="number" min="1"
                                value="{{ old('arrows_per_end', $match->setting?->arrows_per_end ?? 6) }}"
                                placeholder="6" required />

                            @error('arrows_per_end')
                                <p class="text-sm text-destructive">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- =====================================================
                        SCORING SUMMARY
                    ====================================================== --}}

                    <div class="rounded-lg border bg-muted/30 p-4">

                        <div class="flex items-start gap-3">

                            <i data-lucide="info" class="mt-0.5 size-4 shrink-0 text-muted-foreground"></i>

                            <div>

                                <p class="text-sm font-medium">
                                    Scoring Configuration
                                </p>

                                <p class="mt-1 text-sm text-muted-foreground">

                                    This match is configured for

                                    <span class="font-medium text-foreground">
                                        {{ $match->setting?->ends ?? 6 }}
                                        ends
                                    </span>

                                    with

                                    <span class="font-medium text-foreground">
                                        {{ $match->setting?->arrows_per_end ?? 6 }}
                                        arrows
                                    </span>

                                    per end.

                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="flex justify-end">

                        <x-ui.button type="submit">

                            <i data-lucide="save" class="size-4"></i>

                            Save Settings

                        </x-ui.button>

                    </div>

                </form>

            </x-ui.card-content>

        </x-ui.card>

    </div>

@endsection
