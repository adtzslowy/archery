@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    Categories
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Manage competition categories.
                </p>
            </div>

            <a href="{{ route('category.create') }}">
                <x-ui.button type="button">
                    <i data-lucide="plus" class="size-4"></i>
                    Add Category
                </x-ui.button>
            </a>

        </div>


        {{-- Categories Card --}}
        <x-ui.card>

            {{-- Card Header --}}
            <x-ui.card-header>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-base font-semibold">
                            Category List
                        </h2>

                        <p class="text-sm text-muted-foreground">
                            View and manage competition categories.
                        </p>
                    </div>


                    {{-- Search --}}
                    <div class="relative w-full sm:w-72">

                        <i data-lucide="search"
                            class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>

                        <x-ui.input type="search" name="search" placeholder="Search categories..." class="pl-9" />

                    </div>

                </div>

            </x-ui.card-header>


            {{-- Table --}}
            <x-ui.card-content class="p-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-y bg-muted/40">
                            <tr class="text-left">
                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Category
                                </th>
                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Description
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Competitions
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Created
                                </th>

                                <th class="w-20 px-6 py-3">
                                    <span class="sr-only">
                                        Actions
                                    </span>
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse ($categories as $category)
                                <tr class="transition-colors hover:bg-muted/30">

                                    {{-- Category --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex size-9 shrink-0 items-center justify-center rounded-full bg-muted">
                                                <i data-lucide="tag" class="size-4 text-muted-foreground"></i>
                                            </div>

                                            <div class="min-w-0">

                                                <p class="truncate font-medium">
                                                    {{ $category->name }}
                                                </p>

                                                <p class="truncate text-xs text-muted-foreground">
                                                    {{ $category->id }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Description --}}
                                    <td class="px-6 py-4">
                                        <div class="max-w-md truncate text-muted-foreground">
                                            {{ $category->description ?? '-' }}
                                        </div>
                                    </td>


                                    {{-- Competitions --}}
                                    <td class="px-6 py-4">

                                        <x-ui.badge variant="secondary">
                                            {{ $category->competitions_count }}
                                            {{ Str::plural('Competition', $category->competitions_count) }}
                                        </x-ui.badge>

                                    </td>


                                    {{-- Created --}}
                                    <td class="px-6 py-4 text-muted-foreground">

                                        {{ $category->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-' }}

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-4">

                                        <div class="flex justify-end gap-1">

                                            {{-- View --}}
                                            <a href="{{ route('category.show', $category) }}"
                                                class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                                                title="View category">
                                                <i data-lucide="ellipsis" class="size-4"></i>

                                                <span class="sr-only">
                                                    View category
                                                </span>
                                            </a>


                                            {{-- Edit --}}
                                            <a href="{{ route('category.edit', $category) }}"
                                                class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                                                title="Edit category">
                                                <i data-lucide="pencil" class="size-4"></i>

                                                <span class="sr-only">
                                                    Edit category
                                                </span>
                                            </a>


                                            {{-- Delete --}}
                                            <form method="POST" action="{{ route('category.destroy', $category) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this category?');">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive"
                                                    title="Delete category">
                                                    <i data-lucide="trash-2" class="size-4"></i>

                                                    <span class="sr-only">
                                                        Delete category
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
                                                <i data-lucide="tags" class="size-5 text-muted-foreground"></i>
                                            </div>
                                            <h3 class="font-medium">
                                                No categories found
                                            </h3>
                                            <p class="mt-1 text-sm text-muted-foreground">
                                                Start by adding your first category.
                                            </p>
                                            <a href="{{ route('category.create') }}">
                                                <x-ui.button type="button" class="mt-4">
                                                    <i data-lucide="plus" class="size-4"></i>
                                                    Add Category
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
            @if ($categories->hasPages())
                <x-ui.pagination :paginator="$categories" />
            @endif
        </x-ui.card>
    </div>
@endsection
