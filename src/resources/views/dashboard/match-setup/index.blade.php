@extends('layouts.app')

@section('title', 'Match Setup')

@section('content')

    <div x-data="{ addParticipantOpen: false }" class="space-y-6">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div>
            <h1 class="text-2xl font-semibold tracking-tight">
                Match Setup
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                Prepare participants, lanes, and settings before the match begins.
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
                    Select a match to configure its participants.
                </p>

            </x-ui.card-header>


            <x-ui.card-content>

                <form method="GET" action="{{ route('match-setup.index') }}">

                    <select name="match" onchange="this.form.submit()"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring sm:max-w-md">

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

                        <div class="flex items-start gap-4">

                            <div class="flex size-12 shrink-0 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="swords" class="size-5 text-muted-foreground"></i>

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

                                </div>

                            </div>

                        </div>


                        <div class="flex items-center gap-2">

                            <a href="{{ route('match.show', $match) }}">

                                <x-ui.button type="button" variant="outline">

                                    <i data-lucide="eye" class="size-4"></i>

                                    View Match

                                </x-ui.button>

                            </a>

                        </div>

                    </div>

                </x-ui.card-content>

            </x-ui.card>


            {{-- =====================================================
                PARTICIPANTS
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-header>

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <h2 class="text-base font-semibold">
                                Participants
                            </h2>

                            <p class="text-sm text-muted-foreground">
                                Manage participants assigned to this match.
                            </p>

                        </div>


                        <x-ui.button type="button" @click="addParticipantOpen = true">

                            <i data-lucide="user-plus" class="size-4"></i>

                            Add Participant

                        </x-ui.button>

                    </div>

                </x-ui.card-header>


                <x-ui.card-content class="p-0">

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="border-y bg-muted/40">

                                <tr class="text-left">

                                    <th class="w-16 px-6 py-3 font-medium text-muted-foreground">
                                        #
                                    </th>

                                    <th class="px-6 py-3 font-medium text-muted-foreground">
                                        Participant
                                    </th>

                                    <th class="px-6 py-3 font-medium text-muted-foreground">
                                        Gender
                                    </th>

                                    <th class="w-32 px-6 py-3 font-medium text-muted-foreground">
                                        Lane
                                    </th>

                                    <th class="w-28 px-6 py-3 text-right">
                                        <span class="sr-only">
                                            Actions
                                        </span>
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y">

                                @forelse ($participants as $index => $participant)
                                    <tr class="transition-colors hover:bg-muted/30">

                                        {{-- Number --}}
                                        <td class="px-6 py-4 text-muted-foreground">
                                            {{ $index + 1 }}
                                        </td>


                                        {{-- Participant --}}
                                        <td class="px-6 py-4">

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="flex size-9 shrink-0 items-center justify-center rounded-full bg-muted font-medium">

                                                    {{ strtoupper(substr($participant->name, 0, 1)) }}

                                                </div>


                                                <div class="min-w-0">

                                                    <p class="truncate font-medium">
                                                        {{ $participant->name }}
                                                    </p>

                                                    <p class="text-xs text-muted-foreground">
                                                        {{ $participant->participant_number }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Gender --}}
                                        <td class="px-6 py-4 text-muted-foreground">
                                            {{ $participant->gender ?? '-' }}
                                        </td>


                                        {{-- Lane --}}
                                        <td class="px-6 py-4">

                                            <form method="POST"
                                                action="{{ route('match-setup.participants.update', [$match, $participant]) }}"
                                                class="flex items-center gap-2">

                                                @csrf
                                                @method('PUT')

                                                <input type="number" name="lane" min="1"
                                                    value="{{ $participant->pivot->lane }}"
                                                    class="h-9 w-20 rounded-md border border-input bg-background px-3 py-1 text-center text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">

                                                <button type="submit"
                                                    class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                                                    title="Update lane">

                                                    <i data-lucide="save" class="size-4"></i>

                                                    <span class="sr-only">
                                                        Update lane
                                                    </span>

                                                </button>

                                            </form>

                                        </td>


                                        {{-- Actions --}}
                                        <td class="px-6 py-4 text-right">

                                            <form method="POST"
                                                action="{{ route('match-setup.participants.destroy', [$match, $participant]) }}"
                                                onsubmit="return confirm('Remove this participant from the match?');">

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

                                        </td>

                                    </tr>

                                @empty

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
                                                    Add participants to prepare this match.
                                                </p>

                                                <x-ui.button type="button" class="mt-4"
                                                    @click="addParticipantOpen = true">

                                                    <i data-lucide="user-plus" class="size-4"></i>

                                                    Add Participant

                                                </x-ui.button>

                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </x-ui.card-content>

            </x-ui.card>


            {{-- =====================================================
                SETUP SUMMARY
            ====================================================== --}}

            <div class="grid gap-4 sm:grid-cols-3">

                {{-- Participants --}}
                <x-ui.card>

                    <x-ui.card-content class="p-5">

                        <div class="flex items-center gap-3">

                            <div class="flex size-10 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="users" class="size-5 text-muted-foreground"></i>

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

                    </x-ui.card-content>

                </x-ui.card>


                {{-- Assigned Lanes --}}
                <x-ui.card>

                    <x-ui.card-content class="p-5">

                        <div class="flex items-center gap-3">

                            <div class="flex size-10 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="list-ordered" class="size-5 text-muted-foreground"></i>

                            </div>

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Assigned Lanes
                                </p>

                                <p class="text-xl font-semibold">
                                    {{ $participants->whereNotNull('pivot.lane')->count() }}
                                </p>

                            </div>

                        </div>

                    </x-ui.card-content>

                </x-ui.card>


                {{-- Setup Status --}}
                <x-ui.card>

                    <x-ui.card-content class="p-5">

                        <div class="flex items-center gap-3">

                            <div class="flex size-10 items-center justify-center rounded-lg bg-muted">

                                <i data-lucide="clipboard-check" class="size-5 text-muted-foreground"></i>

                            </div>

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Setup Status
                                </p>

                                <p class="text-xl font-semibold">

                                    @if ($participants->isNotEmpty())
                                        Ready
                                    @else
                                        Not Ready
                                    @endif

                                </p>

                            </div>

                        </div>

                    </x-ui.card-content>

                </x-ui.card>

            </div>


            {{-- =====================================================
                MATCH SETTINGS
            ====================================================== --}}

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

                    <form method="POST" action="{{ route('match-setup.settings.update', $match) }}" class="space-y-6">

                        @csrf
                        @method('PUT')


                        {{-- Settings --}}
                        <div class="grid gap-6 sm:grid-cols-3">

                            {{-- Distance --}}
                            <div class="space-y-2">

                                <label for="distance" class="text-sm font-medium">
                                    Distance
                                </label>

                                <div class="relative">

                                    <x-ui.input id="distance" name="distance" type="number" min="1"
                                        value="{{ old('distance', $match->setting?->distance) }}" placeholder="30"
                                        class="pr-10" required />

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


                        {{-- Configuration Information --}}
                        <div class="rounded-lg border bg-muted/30 p-4">

                            <div class="flex items-start gap-3">

                                <div class="flex size-9 shrink-0 items-center justify-center rounded-md bg-muted">

                                    <i data-lucide="info" class="size-4 text-muted-foreground"></i>

                                </div>


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


                        {{-- Save --}}
                        <div class="flex justify-end">

                            <x-ui.button type="submit">

                                <i data-lucide="save" class="size-4"></i>

                                Save Settings

                            </x-ui.button>

                        </div>

                    </form>

                </x-ui.card-content>

            </x-ui.card>


            {{-- =====================================================
                ADD PARTICIPANT MODAL
            ====================================================== --}}

            <div x-show="addParticipantOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-black/50" @click="addParticipantOpen = false"></div>


                {{-- Modal --}}
                <div x-show="addParticipantOpen" x-transition @click.stop
                    class="relative w-full max-w-md rounded-lg border bg-background shadow-lg">

                    <form method="POST" action="{{ route('match-setup.participants.store', $match) }}">

                        @csrf


                        {{-- Modal Header --}}
                        <div class="flex items-start justify-between border-b p-6">

                            <div>

                                <h2 class="text-lg font-semibold">
                                    Add Participant
                                </h2>

                                <p class="mt-1 text-sm text-muted-foreground">
                                    Add a participant to this match.
                                </p>

                            </div>


                            <button type="button" @click="addParticipantOpen = false"
                                class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground">

                                <i data-lucide="x" class="size-4"></i>

                                <span class="sr-only">
                                    Close
                                </span>

                            </button>

                        </div>


                        {{-- Modal Content --}}
                        <div class="space-y-5 p-6">

                            {{-- Participant --}}
                            <div class="space-y-2">

                                <label for="participant_id" class="text-sm font-medium">
                                    Participant
                                </label>

                                <select id="participant_id" name="participant_id" required
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">

                                    <option value="">
                                        Select participant
                                    </option>

                                    @foreach ($availableParticipants as $availableParticipant)
                                        <option value="{{ $availableParticipant->id }}">

                                            {{ $availableParticipant->name }}
                                            — {{ $availableParticipant->participant_number }}

                                        </option>
                                    @endforeach

                                </select>


                                @if ($availableParticipants->isEmpty())
                                    <p class="text-sm text-muted-foreground">
                                        All participants are already assigned to this match.
                                    </p>
                                @endif


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
                                    placeholder="e.g. 1" />

                                <p class="text-xs text-muted-foreground">
                                    You can leave this empty and assign it later.
                                </p>

                                @error('lane')
                                    <p class="text-sm text-destructive">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- Modal Footer --}}
                        <div class="flex justify-end gap-2 border-t p-6">

                            <button type="button" @click="addParticipantOpen = false"
                                class="inline-flex h-10 items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">
                                Cancel
                            </button>


                            <x-ui.button type="submit" :disabled="$availableParticipants->isEmpty()">

                                <i data-lucide="user-plus" class="size-4"></i>

                                Add Participant

                            </x-ui.button>

                        </div>

                    </form>

                </div>

            </div>
        @else
            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}

            <x-ui.card>

                <x-ui.card-content class="flex flex-col items-center justify-center py-20 text-center">

                    <div class="mb-5 flex size-14 items-center justify-center rounded-full bg-muted">

                        <i data-lucide="settings-2" class="size-6 text-muted-foreground"></i>

                    </div>


                    <h2 class="text-lg font-semibold">
                        Select a Match
                    </h2>


                    <p class="mt-1 max-w-md text-sm text-muted-foreground">
                        Select a match above to start configuring participants, lanes, and settings.
                    </p>

                </x-ui.card-content>

            </x-ui.card>

        @endif

    </div>

@endsection
