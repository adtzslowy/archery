@extends('layouts.app')

@section('title', 'Matches')

@section('content')

    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h1 class="text-2xl font-semibold tracking-tight">
                    Matches
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Manage all matches for your competitions.
                </p>

            </div>


            {{-- Add Match --}}
            <a href="{{ route('match.create') }}">

                <x-ui.button type="button">

                    <i data-lucide="plus" class="size-4"></i>

                    Add Match

                </x-ui.button>

            </a>

        </div>


        {{-- Matches Card --}}
        <x-ui.card>

            {{-- Card Header --}}
            <x-ui.card-header>

                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="text-base font-semibold">
                            Match List
                        </h2>

                        <p class="text-sm text-muted-foreground">
                            View and manage all scheduled matches.
                        </p>

                    </div>


                    {{-- Filters --}}
                    <form method="GET" action="{{ route('match.index') }}" class="flex flex-col gap-2 sm:flex-row">

                        {{-- Search --}}
                        <div class="relative w-full sm:w-72">

                            <i data-lucide="search"
                                class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>

                            <x-ui.input type="search" name="search" value="{{ request('search') }}"
                                placeholder="Search matches..." class="pl-9" />

                        </div>


                        {{-- Status --}}
                        <select name="status" onchange="this.form.submit()"
                            class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring sm:w-40">

                            <option value="">
                                All Status
                            </option>

                            <option value="scheduled" @selected(request('status') === 'scheduled')>
                                Scheduled
                            </option>

                            <option value="ongoing" @selected(request('status') === 'ongoing')>
                                Ongoing
                            </option>

                            <option value="completed" @selected(request('status') === 'completed')>
                                Completed
                            </option>

                            <option value="cancelled" @selected(request('status') === 'cancelled')>
                                Cancelled
                            </option>

                        </select>

                    </form>

                </div>

            </x-ui.card-header>


            {{-- Table --}}
            <x-ui.card-content class="p-0">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="border-y bg-muted/40">

                            <tr class="text-left">

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Match
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Competition
                                </th>

                                <th class="w-44 px-6 py-3 font-medium text-muted-foreground">
                                    Schedule
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Location
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Status
                                </th>

                                <th class="w-12 px-6 py-3">
                                    <span class="sr-only">
                                        Actions
                                    </span>
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse ($matches as $match)
                                <tr class="transition-colors hover:bg-muted/30">

                                    {{-- Match --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex size-9 shrink-0 items-center justify-center rounded-full bg-muted">

                                                <i data-lucide="swords" class="size-4 text-muted-foreground"></i>

                                            </div>

                                            <div class="min-w-0">

                                                <p class="truncate font-medium">
                                                    {{ $match->name }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Competition --}}
                                    <td class="px-6 py-4">

                                        @if ($match->competition)
                                            <a href="{{ route('competition.show', $match->competition) }}"
                                                class="font-medium transition-colors hover:text-primary">
                                                {{ $match->competition->name }}
                                            </a>
                                        @else
                                            <span class="text-muted-foreground">
                                                -
                                            </span>
                                        @endif

                                    </td>


                                    {{-- Schedule --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @if ($match->scheduled_at)
                                            <div class="flex flex-col">

                                                <span class="font-medium">
                                                    {{ $match->scheduled_at->format('d M Y') }}
                                                </span>

                                                <span class="text-xs text-muted-foreground">
                                                    {{ $match->scheduled_at->format('H:i') }}
                                                </span>

                                            </div>
                                        @else
                                            <span class="text-muted-foreground">
                                                Not scheduled
                                            </span>
                                        @endif

                                    </td>


                                    {{-- Location --}}
                                    <td class="px-6 py-4">

                                        <div class="flex max-w-56 items-center gap-2">

                                            @if ($match->location)
                                                <i data-lucide="map-pin" class="size-4 shrink-0 text-muted-foreground"></i>

                                                <span class="truncate text-muted-foreground">
                                                    {{ $match->location }}
                                                </span>
                                            @else
                                                <span class="text-muted-foreground">
                                                    -
                                                </span>
                                            @endif

                                        </div>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4">

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

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-4 text-right">

                                        <div class="flex justify-end">

                                            <a href="{{ route('match.show', $match) }}"
                                                class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                                                title="View match">

                                                <i data-lucide="ellipsis" class="size-4"></i>

                                                <span class="sr-only">
                                                    View match
                                                </span>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="mb-4 flex size-12 items-center justify-center rounded-full bg-muted">

                                                <i data-lucide="swords" class="size-5 text-muted-foreground"></i>

                                            </div>

                                            <h3 class="font-medium">
                                                No matches found
                                            </h3>

                                            <p class="mt-1 text-sm text-muted-foreground">
                                                Start by creating your first match.
                                            </p>

                                            <a href="{{ route('match.create') }}">

                                                <x-ui.button type="button" class="mt-4">

                                                    <i data-lucide="plus" class="size-4"></i>

                                                    Add Match

                                                </x-ui.button>

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </x-ui.card-content>


            {{-- Pagination --}}
            @if ($matches->hasPages())
                <x-ui.pagination :paginator="$matches" />
            @endif

        </x-ui.card>

    </div>

@endsection
