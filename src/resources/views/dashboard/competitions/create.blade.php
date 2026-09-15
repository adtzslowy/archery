@extends('layouts.app')

@section('title', 'Create Competition')

@section('content')

    <div class="mx-auto space-y-6">

        {{-- Header --}}
        <div>

            <div class="mb-2 flex items-center gap-2 text-sm text-muted-foreground">

                <a
                    href="{{ route('competition.index') }}"
                    class="transition-colors hover:text-foreground"
                >
                    Competitions
                </a>

                <i
                    data-lucide="chevron-right"
                    class="size-4"
                ></i>

                <span class="text-foreground">
                    Create
                </span>

            </div>

            <h1 class="text-2xl font-semibold tracking-tight">
                Create Competition
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                Create a new archery competition.
            </p>

        </div>


        {{-- Form Card --}}
        <x-ui.card>

            <form
                method="POST"
                action="{{ route('competition.store') }}"
            >

                @csrf

                <x-ui.card-header>

                    <h2 class="text-base font-semibold">
                        Competition Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Enter the competition information below.
                    </p>

                </x-ui.card-header>


                <x-ui.card-content class="space-y-6">

                    {{-- Category --}}
                    <div class="space-y-2">

                        <label
                            for="category_id"
                            class="text-sm font-medium"
                        >
                            Category
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                            required
                        >

                            <option value="">
                                Select category
                            </option>

                            @foreach ($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Competition Name --}}
                    <div class="space-y-2">

                        <label
                            for="name"
                            class="text-sm font-medium"
                        >
                            Competition Name
                        </label>

                        <x-ui.input
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Deswita Archery Championship 2026"
                            required
                        />

                        @error('name')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Description --}}
                    <div class="space-y-2">

                        <label
                            for="description"
                            class="text-sm font-medium"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Describe this competition..."
                            class="flex min-h-20 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Date --}}
                    <div class="grid gap-6 sm:grid-cols-2">

                        {{-- Start Date --}}
                        <div class="space-y-2">

                            <label
                                for="start_date"
                                class="text-sm font-medium"
                            >
                                Start Date
                            </label>

                            <x-ui.input
                                id="start_date"
                                type="date"
                                name="start_date"
                                value="{{ old('start_date') }}"
                            />

                            @error('start_date')
                                <p class="text-sm text-destructive">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- End Date --}}
                        <div class="space-y-2">

                            <label
                                for="end_date"
                                class="text-sm font-medium"
                            >
                                End Date
                            </label>

                            <x-ui.input
                                id="end_date"
                                type="date"
                                name="end_date"
                                value="{{ old('end_date') }}"
                            />

                            @error('end_date')
                                <p class="text-sm text-destructive">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="space-y-2">

                        <label
                            for="status"
                            class="text-sm font-medium"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                            required
                        >

                            <option
                                value="draft"
                                @selected(old('status', 'draft') === 'draft')
                            >
                                Draft
                            </option>

                            <option
                                value="scheduled"
                                @selected(old('status') === 'scheduled')
                            >
                                Scheduled
                            </option>

                            <option
                                value="ongoing"
                                @selected(old('status') === 'ongoing')
                            >
                                Ongoing
                            </option>

                            <option
                                value="completed"
                                @selected(old('status') === 'completed')
                            >
                                Completed
                            </option>

                            <option
                                value="cancelled"
                                @selected(old('status') === 'cancelled')
                            >
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


                {{-- Footer --}}
                <x-ui.card-footer class="justify-end gap-2">

                    <a
                        href="{{ route('competition.index') }}"
                        class="inline-flex h-10 items-center justify-center rounded-md px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground"
                    >
                        Cancel
                    </a>

                    <x-ui.button type="submit">

                        <i
                            data-lucide="plus"
                            class="size-4"
                        ></i>

                        Create Competition

                    </x-ui.button>

                </x-ui.card-footer>

            </form>

        </x-ui.card>

    </div>

@endsection