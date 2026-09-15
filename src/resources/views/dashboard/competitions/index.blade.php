@extends('layouts.app')

@section('title', 'Competitions')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    Competitions
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Manage archery competitions and events.
                </p>
            </div>

            <a href="{{ route('competition.create') }}">
                <x-ui.button type="button">
                    <i data-lucide="plus" class="size-4"></i>
                    Create Competition
                </x-ui.button>
            </a>

        </div>


        {{-- Competition Card --}}
        <x-ui.card>

            <x-ui.card-header>

                <div>
                    <h2 class="text-base font-semibold">
                        Competition List
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        View and manage all competitions.
                    </p>
                </div>

            </x-ui.card-header>


            <x-ui.card-content class="p-0">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="border-y bg-muted/40">

                            <tr class="text-left">

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Competition
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Category
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Date
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Status
                                </th>

                                <th class="w-20 px-6 py-3">
                                    <span class="sr-only">
                                        Actions
                                    </span>
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse ($competitions as $competition)
                                <tr class="transition-colors hover:bg-muted/30">

                                    {{-- Competition --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex size-9 shrink-0 items-center justify-center rounded-full bg-muted">
                                                <i data-lucide="trophy" class="size-4 text-muted-foreground"></i>
                                            </div>

                                            <div class="min-w-0">

                                                <p class="truncate font-medium">
                                                    {{ $competition->name }}
                                                </p>

                                                <p class="truncate text-xs text-muted-foreground">
                                                    {{ $competition->description ?? 'No description' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Category --}}
                                    <td class="px-6 py-4 text-muted-foreground">
                                        {{ $competition->category?->name ?? '-' }}
                                    </td>


                                    {{-- Date --}}
                                    <td class="px-6 py-4 text-muted-foreground">

                                        @if ($competition->start_date && $competition->end_date)
                                            {{ $competition->start_date->format('d M Y') }}
                                            -
                                            {{ $competition->end_date->format('d M Y') }}
                                        @elseif ($competition->start_date)
                                            {{ $competition->start_date->format('d M Y') }}
                                        @else
                                            -
                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4">

                                        @php
                                            $variant = match ($competition->status) {
                                                'draft' => 'secondary',
                                                'scheduled' => 'default',
                                                'ongoing' => 'success',
                                                'completed' => 'outline',
                                                'cancelled' => 'destructive',
                                                default => 'secondary',
                                            };
                                        @endphp

                                        <x-ui.badge :variant="$variant">
                                            {{ ucfirst($competition->status) }}
                                        </x-ui.badge>

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-4">

                                        <div class="flex justify-end gap-1">

                                            {{-- View --}}
                                            <a href="{{ route('competition.show', $competition) }}"
                                                class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                                                title="View competition">
                                                <i data-lucide="ellipsis" class="size-4"></i>

                                                <span class="sr-only">
                                                    View competition
                                                </span>
                                            </a>


                                            {{-- Delete --}}
                                            <form method="POST" action="{{ route('competition.destroy', $competition) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this competition?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive"
                                                    title="Delete competition">
                                                    <i data-lucide="trash-2" class="size-4"></i>

                                                    <span class="sr-only">
                                                        Delete competition
                                                    </span>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="mb-4 flex size-12 items-center justify-center rounded-full bg-muted">

                                                <i data-lucide="trophy" class="size-5 text-muted-foreground"></i>

                                            </div>

                                            <h3 class="font-medium">
                                                No competitions found
                                            </h3>

                                            <p class="mt-1 text-sm text-muted-foreground">
                                                Start by creating your first competition.
                                            </p>

                                            <a href="{{ route('competition.create') }}">
                                                <x-ui.button type="button" class="mt-4">
                                                    <i data-lucide="plus" class="size-4"></i>

                                                    Create Competition
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
            @if ($competitions->hasPages())
                <x-ui.pagination :paginator="$competitions" />
            @endif

        </x-ui.card>

    </div>

@endsection
