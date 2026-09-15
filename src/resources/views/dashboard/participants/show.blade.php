@extends('layouts.app')

@section('title', 'Participant Details')

@section('content')

    <div class="mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start justify-between gap-4">

            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-muted-foreground">

                    <a href="{{ route('partisipan.index') }}" class="transition-colors hover:text-foreground">
                        Participants
                    </a>

                    <i data-lucide="chevron-right" class="size-4"></i>

                    <span class="text-foreground">
                        Details
                    </span>

                </div>

                <h1 class="text-2xl font-semibold tracking-tight">
                    {{ $participant->name }}
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Participant #{{ $participant->participant_number }}
                </p>
            </div>

            <a href="{{ route('partisipan.edit', $participant) }}">
                <x-ui.button type="button">
                    <i data-lucide="pencil" class="size-4"></i>
                    Edit
                </x-ui.button>
            </a>

        </div>


        {{-- Participant Information --}}
        <x-ui.card>

            <x-ui.card-header>
                <div class="flex items-center gap-3">

                    <div class="flex size-12 items-center justify-center rounded-full bg-muted text-lg font-semibold">
                        {{ strtoupper(substr($participant->name, 0, 1)) }}
                    </div>

                    <div>
                        <h2 class="font-semibold">
                            {{ $participant->name }}
                        </h2>

                        <p class="text-sm text-muted-foreground">
                            {{ $participant->participant_number }}
                        </p>
                    </div>

                </div>
            </x-ui.card-header>


            <x-ui.card-content>

                <dl class="grid gap-6 sm:grid-cols-2">

                    {{-- Participant Number --}}
                    <div>
                        <dt class="text-sm text-muted-foreground">
                            Participant Number
                        </dt>

                        <dd class="mt-1 font-medium">
                            {{ $participant->participant_number }}
                        </dd>
                    </div>


                    {{-- Name --}}
                    <div>
                        <dt class="text-sm text-muted-foreground">
                            Full Name
                        </dt>

                        <dd class="mt-1 font-medium">
                            {{ $participant->name }}
                        </dd>
                    </div>


                    {{-- Gender --}}
                    <div>
                        <dt class="text-sm text-muted-foreground">
                            Gender
                        </dt>

                        <dd class="mt-1 font-medium capitalize">
                            {{ $participant->gender ?? '-' }}
                        </dd>
                    </div>


                    {{-- Birth Date --}}
                    <div>
                        <dt class="text-sm text-muted-foreground">
                            Birth Date
                        </dt>

                        <dd class="mt-1 font-medium">
                            {{ $participant->birth_date?->format('d F Y') ?? '-' }}
                        </dd>
                    </div>


                    {{-- Created --}}
                    <div>
                        <dt class="text-sm text-muted-foreground">
                            Registered At
                        </dt>

                        <dd class="mt-1 font-medium">
                            {{ $participant->created_at?->timezone('Asia/Jakarta')->format('d F Y, H:i') ?? '-' }}
                        </dd>
                    </div>

                </dl>

            </x-ui.card-content>

        </x-ui.card>


        {{-- Back --}}
        <div>
            <a href="{{ route('partisipan.index') }}"
                class="inline-flex items-center gap-2 text-sm text-muted-foreground transition-colors hover:text-foreground">
                <i data-lucide="arrow-left" class="size-4"></i>
                Back to Participants
            </a>
        </div>

    </div>

@endsection
