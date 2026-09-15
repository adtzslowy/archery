@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

    <div class="mx-auto space-y-6">

        {{-- Header --}}
        <div>

            <div class="mb-2 flex items-center gap-2 text-sm text-muted-foreground">

                <a href="{{ route('category.index') }}" class="transition-colors hover:text-foreground">
                    Categories
                </a>

                <i data-lucide="chevron-right" class="size-4"></i>

                <a href="{{ route('category.show', $category) }}" class="transition-colors hover:text-foreground">
                    {{ $category->name }}
                </a>

                <i data-lucide="chevron-right" class="size-4"></i>

                <span class="text-foreground">
                    Edit
                </span>

            </div>

            <h1 class="text-2xl font-semibold tracking-tight">
                Edit Category
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                Update the information for this category.
            </p>

        </div>


        {{-- Form Card --}}
        <x-ui.card>

            <form method="POST" action="{{ route('category.update', $category) }}">

                @csrf
                @method('PUT')

                <x-ui.card-header>

                    <h2 class="text-base font-semibold">
                        Category Information
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        Modify the category information below.
                    </p>

                </x-ui.card-header>


                <x-ui.card-content class="space-y-6">

                    {{-- Name --}}
                    <div class="space-y-2">

                        <label for="name" class="text-sm font-medium">
                            Category Name
                        </label>

                        <x-ui.input id="name" name="name" value="{{ old('name', $category->name) }}"
                            placeholder="e.g. Senior Male" required />

                        @error('name')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Description --}}
                    <div class="space-y-2">

                        <label for="description" class="text-sm font-medium">
                            Description
                        </label>

                        <textarea id="description" name="description" rows="4" placeholder="Describe this category..."
                            class="flex min-h-20 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">{{ old('description', $category->description) }}</textarea>

                        @error('description')
                            <p class="text-sm text-destructive">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </x-ui.card-content>


                {{-- Footer --}}
                <x-ui.card-footer class="justify-between">

                    <a href="{{ route('category.show', $category) }}"
                        class="inline-flex h-10 items-center justify-center gap-2 rounded-md px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground">

                        <i data-lucide="arrow-left" class="size-4"></i>

                        Cancel

                    </a>


                    <x-ui.button type="submit">

                        <i data-lucide="save" class="size-4"></i>

                        Save Changes

                    </x-ui.button>

                </x-ui.card-footer>

            </form>

        </x-ui.card>

    </div>

@endsection
