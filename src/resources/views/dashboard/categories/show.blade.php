@extends('layouts.app')

@section('title', $category->name)

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="mb-2 flex items-center gap-2 text-sm text-muted-foreground">

                    <a href="{{ route('category.index') }}" class="transition-colors hover:text-foreground">
                        Categories
                    </a>

                    <i data-lucide="chevron-right" class="size-4"></i>

                    <span class="text-foreground">
                        {{ $category->name }}
                    </span>

                </div>

                <h1 class="text-2xl font-semibold tracking-tight">
                    {{ $category->name }}
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    View category information and related competitions.
                </p>

            </div>


            {{-- Actions --}}
            <div class="flex items-center gap-2">

                <a href="{{ route('category.edit', $category) }}">

                    <x-ui.button variant="outline" type="button">

                        <i data-lucide="pencil" class="size-4"></i>

                        Edit

                    </x-ui.button>

                </a>

                <form method="POST" action="{{ route('category.destroy', $category) }}"
                    onsubmit="return confirm('Are you sure you want to delete this category?');">

                    @csrf
                    @method('DELETE')

                    <x-ui.button type="submit" variant="destructive">

                        <i data-lucide="trash-2" class="size-4"></i>

                        Delete

                    </x-ui.button>

                </form>

            </div>

        </div>


        {{-- Information --}}
        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Main Information --}}
            <x-ui.card class="lg:col-span-2">

                <x-ui.card-header>

                    <h2 class="text-base font-semibold">
                        Category Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Details about this category.
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
                                {{ $category->name }}
                            </dd>

                        </div>


                        {{-- Description --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Description
                            </dt>

                            <dd class="sm:col-span-2">

                                @if ($category->description)
                                    <p class="whitespace-pre-line font-medium">
                                        {{ $category->description }}
                                    </p>
                                @else
                                    <span class="text-muted-foreground">
                                        No description provided.
                                    </span>
                                @endif

                            </dd>

                        </div>


                        {{-- ID --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                ID
                            </dt>

                            <dd class="break-all font-mono text-xs sm:col-span-2">
                                {{ $category->id }}
                            </dd>

                        </div>


                        {{-- Created --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Created
                            </dt>

                            <dd class="font-medium sm:col-span-2">
                                {{ $category->created_at?->timezone('Asia/Jakarta')->format('d F Y, H:i') ?? '-' }}
                            </dd>

                        </div>


                        {{-- Updated --}}
                        <div class="grid gap-1 py-4 sm:grid-cols-3">

                            <dt class="text-sm text-muted-foreground">
                                Last Updated
                            </dt>

                            <dd class="font-medium sm:col-span-2">
                                {{ $category->updated_at?->timezone('Asia/Jakarta')->format('d F Y, H:i') ?? '-' }}
                            </dd>

                        </div>

                    </dl>

                </x-ui.card-content>

            </x-ui.card>


            {{-- Statistics --}}
            <x-ui.card>

                <x-ui.card-header>

                    <h2 class="text-base font-semibold">
                        Overview
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Category statistics.
                    </p>

                </x-ui.card-header>


                <x-ui.card-content class="space-y-4">

                    {{-- Competitions --}}
                    <div class="rounded-lg border p-4">

                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-3">

                                <div class="flex size-9 items-center justify-center rounded-md bg-muted">

                                    <i data-lucide="trophy" class="size-4 text-muted-foreground"></i>

                                </div>

                                <div>

                                    <p class="text-sm text-muted-foreground">
                                        Competitions
                                    </p>

                                    <p class="text-xl font-semibold">
                                        {{ $category->competitions_count }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Created --}}
                    <div class="rounded-lg border p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex size-9 items-center justify-center rounded-md bg-muted">

                                <i data-lucide="calendar-plus" class="size-4 text-muted-foreground"></i>

                            </div>

                            <div>

                                <p class="text-sm text-muted-foreground">
                                    Created
                                </p>

                                <p class="font-medium">
                                    {{ $category->created_at?->timezone('Asia/Jakarta')->format('d M Y') ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </x-ui.card-content>

            </x-ui.card>

        </div>


        {{-- Back --}}
        <div>

            <a href="{{ route('category.index') }}"
                class="inline-flex items-center gap-2 text-sm text-muted-foreground transition-colors hover:text-foreground">

                <i data-lucide="arrow-left" class="size-4"></i>

                Back to Categories

            </a>

        </div>

    </div>

@endsection
