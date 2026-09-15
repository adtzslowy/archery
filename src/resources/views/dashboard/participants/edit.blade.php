@extends('layouts.app')

@section('title', 'Edit Participant')

@section('content')

    <div class="mx-auto space-y-6">

        {{-- Header --}}
        <div>

            <div class="mb-2 flex items-center gap-2 text-sm text-muted-foreground">

                <a
                    href="{{ route('partisipan.index') }}"
                    class="transition-colors hover:text-foreground"
                >
                    Participants
                </a>

                <i
                    data-lucide="chevron-right"
                    class="size-4"
                ></i>

                <a
                    href="{{ route('partisipan.show', $participant) }}"
                    class="transition-colors hover:text-foreground"
                >
                    {{ $participant->name }}
                </a>

                <i
                    data-lucide="chevron-right"
                    class="size-4"
                ></i>

                <span class="text-foreground">
                    Edit
                </span>

            </div>

            <h1 class="text-2xl font-semibold tracking-tight">
                Edit Participant
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                Update participant information.
            </p>

        </div>


        {{-- Form Card --}}
        <x-ui.card>

            <form
                method="POST"
                action="{{ route('partisipan.update', $participant) }}"
            >

                @csrf
                @method('PUT')


                <x-ui.card-header>

                    <h2 class="text-base font-semibold">
                        Participant Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Update the participant's information below.
                    </p>

                </x-ui.card-header>


                <x-ui.card-content class="space-y-6">

                    {{-- Participant Number --}}
                    <div class="space-y-2">

                        <label
                            for="participant_number"
                            class="text-sm font-medium"
                        >
                            Participant Number
                        </label>

                        <x-ui.input
                            id="participant_number"
                            name="participant_number"
                            value="{{ old('participant_number', $participant->participant_number) }}"
                            placeholder="e.g. P001"
                            required
                        />

                        @error('participant_number')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Name --}}
                    <div class="space-y-2">

                        <label
                            for="name"
                            class="text-sm font-medium"
                        >
                            Full Name
                        </label>

                        <x-ui.input
                            id="name"
                            name="name"
                            value="{{ old('name', $participant->name) }}"
                            placeholder="Enter participant name"
                            required
                        />

                        @error('name')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Gender --}}
                    <div class="space-y-2">

                        <label
                            for="gender"
                            class="text-sm font-medium"
                        >
                            Gender
                        </label>

                        <select
                            id="gender"
                            name="gender"
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                        >

                            <option value="">
                                Select gender
                            </option>

                            <option
                                value="male"
                                @selected(old('gender', $participant->gender) === 'male')
                            >
                                Male
                            </option>

                            <option
                                value="female"
                                @selected(old('gender', $participant->gender) === 'female')
                            >
                                Female
                            </option>

                        </select>

                        @error('gender')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Birth Date --}}
                    <div class="space-y-2">

                        <label
                            for="birth_date"
                            class="text-sm font-medium"
                        >
                            Birth Date
                        </label>

                        <x-ui.input
                            id="birth_date"
                            type="date"
                            name="birth_date"
                            value="{{ old('birth_date', $participant->birth_date?->format('Y-m-d')) }}"
                        />

                        @error('birth_date')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </x-ui.card-content>


                {{-- Actions --}}
                <x-ui.card-footer class="justify-end gap-2">

                    <a
                        href="{{ route('partisipan.show', $participant) }}"
                        class="inline-flex h-10 items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground"
                    >
                        Cancel
                    </a>

                    <x-ui.button type="submit">

                        <i
                            data-lucide="save"
                            class="size-4"
                        ></i>

                        Save Changes

                    </x-ui.button>

                </x-ui.card-footer>

            </form>

        </x-ui.card>

    </div>

@endsection