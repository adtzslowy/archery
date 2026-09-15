@extends('layouts.app')

@section('title', $competition->name)

@section('content')

    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                {{-- Breadcrumb --}}
                <div class="mb-2 flex items-center gap-2 text-sm text-muted-foreground">

                    <a href="{{ route('competition.index') }}" class="transition-colors hover:text-foreground">
                        Competitions
                    </a>

                    <i data-lucide="chevron-right" class="size-4"></i>

                    <span class="text-foreground">
                        {{ $competition->name }}
                    </span>

                </div>

                <h1 class="text-2xl font-semibold tracking-tight">
                    {{ $competition->name }}
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    View competition information and details.
                </p>

            </div>


            {{-- Actions --}}
            <div class="flex items-center gap-2">

                <a href="{{ route('competition.edit', $competition) }}">

                    <x-ui.button type="button" variant="outline">
                        <i data-lucide="pencil" class="size-4"></i>

                        Edit
                    </x-ui.button>

                </a>


                <form method="POST" action="{{ route('competition.destroy', $competition) }}"
                    onsubmit="return confirm('Are you sure you want to delete this competition?');">

                    @csrf
                    @method('DELETE')

                    <x-ui.button type="submit" variant="destructive">
                        <i data-lucide="trash-2" class="size-4"></i>

                        Delete
                    </x-ui.button>

                </form>

            </div>

        </div>


        {{-- Main Content --}}
        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Competition Information --}}
            <x-ui.card class="lg:col-span-2">

                <x-ui.card-header>

                    <h2 class="text-base font-semibold">
                        Competition Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Details about this competition.
                    </p>

                </x-ui.card-header>


                <x-ui.card-content>

                    <dl class="divide-y">

                        {{-- Name --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Name
                            </dt>

                            <dd class="font-medium sm:col-span-2">
                                {{ $competition->name }}
                            </dd>

                        </div>


                        {{-- Category --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Category
                            </dt>

                            <dd class="font-medium sm:col-span-2">

                                @if ($competition->category)
                                    {{ $competition->category->name }}
                                @else
                                    <span class="text-muted-foreground">
                                        -
                                    </span>
                                @endif

                            </dd>

                        </div>


                        {{-- Description --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Description
                            </dt>

                            <dd class="sm:col-span-2">

                                @if ($competition->description)
                                    <p class="whitespace-pre-line font-medium">
                                        {{ $competition->description }}
                                    </p>
                                @else
                                    <span class="text-muted-foreground">
                                        No description provided.
                                    </span>
                                @endif

                            </dd>

                        </div>


                        {{-- Start Date --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Start Date
                            </dt>

                            <dd class="font-medium sm:col-span-2">
                                {{ $competition->start_date?->format('d F Y') ?? '-' }}
                            </dd>

                        </div>


                        {{-- End Date --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                End Date
                            </dt>

                            <dd class="font-medium sm:col-span-2">
                                {{ $competition->end_date?->format('d F Y') ?? '-' }}
                            </dd>

                        </div>


                        {{-- Status --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Status
                            </dt>

                            <dd class="sm:col-span-2">

                                @php
                                    $statusVariant = match ($competition->status) {
                                        'draft' => 'secondary',
                                        'upcoming' => 'warning',
                                        'ongoing' => 'success',
                                        'completed' => 'default',
                                        default => 'secondary',
                                    };
                                @endphp

                                <x-ui.badge :variant="$statusVariant">
                                    {{ ucfirst($competition->status) }}
                                </x-ui.badge>

                            </dd>

                        </div>


                        {{-- ID --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                ID
                            </dt>

                            <dd class="break-all font-mono text-xs sm:col-span-2">
                                {{ $competition->id }}
                            </dd>

                        </div>


                        {{-- Created --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Created
                            </dt>

                            <dd class="font-medium sm:col-span-2">
                                {{ $competition->created_at?->timezone('Asia/Jakarta')->format('d F Y, H:i') ?? '-' }}
                            </dd>

                        </div>


                        {{-- Updated --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Last Updated
                            </dt>

                            <dd class="font-medium sm:col-span-2">
                                {{ $competition->updated_at?->timezone('Asia/Jakarta')->format('d F Y, H:i') ?? '-' }}
                            </dd>

                        </div>

                    </dl>

                </x-ui.card-content>

            </x-ui.card>


            {{-- Overview --}}
            <x-ui.card>

                <x-ui.card-header>

                    <h2 class="text-base font-semibold">
                        Overview
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Competition summary.
                    </p>

                </x-ui.card-header>


                <x-ui.card-content class="space-y-4">

                    {{-- Category --}}
                    <div class="rounded-lg border p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">

                                <i data-lucide="tag" class="size-4 text-muted-foreground"></i>

                            </div>

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Category
                                </p>

                                <p class="font-medium">
                                    {{ $competition->category?->name ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Schedule --}}
                    <div class="rounded-lg border p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">

                                <i data-lucide="calendar" class="size-4 text-muted-foreground"></i>

                            </div>

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Schedule
                                </p>

                                <p class="font-medium">

                                    @if ($competition->start_date && $competition->end_date)
                                        {{ $competition->start_date->format('d M Y') }}
                                        -
                                        {{ $competition->end_date->format('d M Y') }}
                                    @elseif ($competition->start_date)
                                        {{ $competition->start_date->format('d M Y') }}
                                    @else
                                        Not scheduled
                                    @endif

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="rounded-lg border p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">

                                <i data-lucide="activity" class="size-4 text-muted-foreground"></i>

                            </div>

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Status
                                </p>

                                <p class="font-medium">
                                    {{ ucfirst($competition->status) }}
                                </p>

                            </div>

                        </div>

                    </div>

                </x-ui.card-content>

            </x-ui.card>

        </div>


        {{-- Back --}}
        <div>

            <a href="{{ route('competition.index') }}"
                class="inline-flex items-center gap-2 text-sm text-muted-foreground transition-colors hover:text-foreground">

                <i data-lucide="arrow-left" class="size-4"></i>

                Back to Competitions

            </a>

        </div>

    </div>

@endsection
