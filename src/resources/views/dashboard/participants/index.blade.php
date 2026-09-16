@extends('layouts.app')

@section('title', 'Participants')

@section('content')

    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    Participants
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Manage all registered archers.
                </p>
            </div>

            <a href="{{ route('partisipan.create') }}">
                <x-ui.button type="button">
                    <i data-lucide="plus" class="size-4"></i>
                    Add Participant
                </x-ui.button>
            </a>

        </div>


        {{-- Participants Card --}}
        <x-ui.card>

            {{-- Card Header --}}
            <x-ui.card-header>
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-base font-semibold">
                            Participant List
                        </h2>

                        <p class="text-sm text-muted-foreground">
                            View and manage participant information.
                        </p>
                    </div>

                    {{-- Search --}}
                    <div class="relative w-full sm:w-72">

                        <i data-lucide="search"
                            class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>

                        <x-ui.input type="search" name="search" placeholder="Search participants..." class="pl-9" />

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
                                    Participant
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Gender
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Category
                                </th>

                                <th class="px-6 py-3 font-medium text-muted-foreground">
                                    Club
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

                            @forelse ($participants as $participant)
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


                                    {{-- Gender --}}
                                    <td class="px-6 py-4 text-muted-foreground">
                                        {{ $participant->gender ?? '-' }}
                                    </td>


                                    {{-- Category --}}
                                    <td class="px-6 py-4 text-muted-foreground">
                                        {{ $participant->category ?? '-' }}
                                    </td>


                                    {{-- Club --}}
                                    <td class="px-6 py-4 text-muted-foreground">
                                        {{ $participant->club ?? '-' }}
                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4">

                                        <x-ui.badge variant="success">
                                            Active
                                        </x-ui.badge>

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-1">

                                            {{-- View --}}
                                            <a href="{{ route('partisipan.show', $participant) }}"
                                                class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                                                title="View participant">
                                                <i data-lucide="ellipsis" class="size-4"></i>

                                                <span class="sr-only">
                                                    View participant
                                                </span>
                                            </a>


                                            {{-- Delete --}}
                                            <form method="POST" action="{{ route('partisipan.destroy', $participant) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this participant?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex cursor-pointer size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-destructive/10 hover:text-destructive"
                                                    title="Delete participant">
                                                    <i data-lucide="trash-2" class="size-4"></i>

                                                    <span class="sr-only">
                                                        Delete participant
                                                    </span>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="mb-4 flex size-12 items-center justify-center rounded-full bg-muted">
                                                <i data-lucide="users" class="size-5 text-muted-foreground"></i>
                                            </div>

                                            <h3 class="font-medium">
                                                No participants found
                                            </h3>

                                            <p class="mt-1 text-sm text-muted-foreground">
                                                Start by adding your first participant.
                                            </p>

                                            <a href="{{ route('partisipan.create') }}">
                                                <x-ui.button type="button" class="mt-4">
                                                    <i data-lucide="plus" class="size-4"></i>
                                                    Add Participant
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
            @if ($participants->hasPages())
                <x-ui.pagination :paginator="$participants" />
            @endif

        </x-ui.card>

    </div>

@endsection
