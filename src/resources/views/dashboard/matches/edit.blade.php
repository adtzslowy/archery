@extends('layouts.app')

@section('title', 'Edit Match')

@section('content')

    <div class="mx-auto space-y-6">

        {{-- Page Header --}}
        <div>

            {{-- Breadcrumb --}}
            <div class="mb-2 flex items-center gap-2 text-sm text-muted-foreground">

                <a href="{{ route('match.index') }}" class="transition-colors hover:text-foreground">
                    Matches
                </a>

                <i data-lucide="chevron-right" class="size-4"></i>

                <a href="{{ route('match.show', $match) }}" class="max-w-48 truncate transition-colors hover:text-foreground">
                    {{ $match->name }}
                </a>

                <i data-lucide="chevron-right" class="size-4"></i>

                <span class="text-foreground">
                    Edit
                </span>

            </div>


            <h1 class="text-2xl font-semibold tracking-tight">
                Edit Match
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                Update the information for this match.
            </p>

        </div>


        {{-- Form Card --}}
        <x-ui.card>

            <form method="POST" action="{{ route('match.update', $match) }}">

                @csrf
                @method('PUT')


                {{-- Card Header --}}
                <x-ui.card-header>

                    <h2 class="text-base font-semibold">
                        Match Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Modify the match information below.
                    </p>

                </x-ui.card-header>


                {{-- Card Content --}}
                <x-ui.card-content class="space-y-6">

                    {{-- Competition --}}
                    <div class="space-y-2">

                        <label for="competition_id" class="text-sm font-medium">
                            Competition
                        </label>

                        <select id="competition_id" name="competition_id" required
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">

                            <option value="">
                                Select competition
                            </option>

                            @foreach ($competitions as $competition)
                                <option value="{{ $competition->id }}" @selected(old('competition_id', $match->competition_id) == $competition->id)>
                                    {{ $competition->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('competition_id')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Match Name --}}
                    <div class="space-y-2">

                        <label for="name" class="text-sm font-medium">
                            Match Name
                        </label>

                        <x-ui.input id="name" name="name" value="{{ old('name', $match->name) }}"
                            placeholder="e.g. Qualification Round 1" required />

                        @error('name')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Scheduled At --}}
                    <div class="space-y-2">

                        <label for="scheduled_at" class="text-sm font-medium">
                            Scheduled At
                        </label>

                        <x-ui.input id="scheduled_at" name="scheduled_at" type="datetime-local"
                            value="{{ old('scheduled_at', $match->scheduled_at?->format('Y-m-d\TH:i')) }}" />

                        <p class="text-xs text-muted-foreground">
                            Leave empty if the match has not been scheduled yet.
                        </p>

                        @error('scheduled_at')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Location --}}
                    <div class="space-y-2">

                        <label for="location" class="text-sm font-medium">
                            Location
                        </label>

                        <div class="relative">

                            <i data-lucide="map-pin"
                                class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>

                            <x-ui.input id="location" name="location" value="{{ old('location', $match->location) }}"
                                placeholder="e.g. Lapangan Panahan Deswita" class="pl-9" />

                        </div>

                        @error('location')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="space-y-2">

                        <label for="status" class="text-sm font-medium">
                            Status
                        </label>

                        <select id="status" name="status" required
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">

                            <option value="scheduled" @selected(old('status', $match->status) === 'scheduled')>
                                Scheduled
                            </option>

                            <option value="ongoing" @selected(old('status', $match->status) === 'ongoing')>
                                Ongoing
                            </option>

                            <option value="completed" @selected(old('status', $match->status) === 'completed')>
                                Completed
                            </option>

                            <option value="cancelled" @selected(old('status', $match->status) === 'cancelled')>
                                Cancelled
                            </option>

                        </select>

                        @error('status')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </x-ui.card-content>


                {{-- Card Footer --}}
                <x-ui.card-footer class="justify-between">

                    {{-- Cancel --}}
                    <a href="{{ route('match.show', $match) }}"
                        class="inline-flex h-10 items-center justify-center gap-2 rounded-md px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">

                        <i data-lucide="arrow-left" class="size-4"></i>

                        Cancel

                    </a>


                    {{-- Submit --}}
                    <x-ui.button type="submit">

                        <i data-lucide="save" class="size-4"></i>

                        Save Changes

                    </x-ui.button>

                </x-ui.card-footer>

            </form>

        </x-ui.card>

    </div>

@endsection
