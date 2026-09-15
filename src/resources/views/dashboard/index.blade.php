@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="space-y-8">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">
                Dashboard
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                Overview of your archery scoring system.
            </p>
        </div>

        {{-- Statistics --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Participants --}}
            <div class="rounded-xl border bg-card p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <p class="text-sm font-medium text-muted-foreground">
                        Participants
                    </p>

                    <div class="rounded-md bg-muted p-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-3xl font-semibold tracking-tight">
                    0
                </p>

                <p class="mt-1 text-xs text-muted-foreground">
                    Registered participants
                </p>

            </div>

            {{-- Competitions --}}
            <div class="rounded-xl border bg-card p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <p class="text-sm font-medium text-muted-foreground">
                        Competitions
                    </p>

                    <div class="rounded-md bg-muted p-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <path d="M8 21h8" />
                            <path d="M12 17v4" />
                            <path d="M5 4h14" />
                            <path d="M7 4v5a5 5 0 0 0 10 0V4" />
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-3xl font-semibold tracking-tight">
                    0
                </p>

                <p class="mt-1 text-xs text-muted-foreground">
                    Total competitions
                </p>

            </div>

            {{-- Matches --}}
            <div class="rounded-xl border bg-card p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <p class="text-sm font-medium text-muted-foreground">
                        Matches
                    </p>

                    <div class="rounded-md bg-muted p-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <path d="M8 6h13" />
                            <path d="M8 12h13" />
                            <path d="M8 18h13" />
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-3xl font-semibold tracking-tight">
                    0
                </p>

                <p class="mt-1 text-xs text-muted-foreground">
                    Total matches
                </p>

            </div>

            {{-- Scores --}}
            <div class="rounded-xl border bg-card p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <p class="text-sm font-medium text-muted-foreground">
                        Scores
                    </p>

                    <div class="rounded-md bg-muted p-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="size-4"
                        >
                            <circle cx="12" cy="12" r="9" />
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-3xl font-semibold tracking-tight">
                    0
                </p>

                <p class="mt-1 text-xs text-muted-foreground">
                    Scores recorded
                </p>

            </div>

        </div>

        {{-- Content --}}
        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Upcoming Matches --}}
            <div class="rounded-xl border bg-card shadow-sm lg:col-span-2">

                <div class="border-b px-6 py-4">

                    <h2 class="text-sm font-semibold">
                        Upcoming Matches
                    </h2>

                    <p class="mt-1 text-xs text-muted-foreground">
                        Your next scheduled matches.
                    </p>

                </div>

                <div class="flex min-h-64 items-center justify-center px-6">

                    <div class="text-center">

                        <div
                            class="mx-auto flex size-10 items-center justify-center rounded-lg bg-muted"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="size-5 text-muted-foreground"
                            >
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                                <path d="M16 2v4" />
                                <path d="M8 2v4" />
                                <path d="M3 10h18" />
                            </svg>
                        </div>

                        <p class="mt-3 text-sm font-medium">
                            No upcoming matches
                        </p>

                        <p class="mt-1 text-xs text-muted-foreground">
                            Scheduled matches will appear here.
                        </p>

                    </div>

                </div>

            </div>

            {{-- Quick Actions --}}
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

                    <a
                        href="#"
                        class="flex items-center gap-3 rounded-lg border p-3 transition-colors hover:bg-accent"
                    >
                        <div class="rounded-md bg-muted p-2">
                            <span class="text-sm">+</span>
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

                    <a
                        href="#"
                        class="flex items-center gap-3 rounded-lg border p-3 transition-colors hover:bg-accent"
                    >
                        <div class="rounded-md bg-muted p-2">
                            <span class="text-sm">+</span>
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

                    <a
                        href="#"
                        class="flex items-center gap-3 rounded-lg border p-3 transition-colors hover:bg-accent"
                    >
                        <div class="rounded-md bg-muted p-2">
                            <span class="text-sm">+</span>
                        </div>

                        <div>
                            <p class="text-sm font-medium">
                                Schedule Match
                            </p>

                            <p class="text-xs text-muted-foreground">
                                Create a match schedule
                            </p>
                        </div>
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection