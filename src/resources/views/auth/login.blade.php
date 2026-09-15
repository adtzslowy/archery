@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<div class="flex min-h-screen items-center justify-center px-6 py-12">

    <div class="w-full max-w-sm">

        {{-- Branding --}}
        <div class="mb-8 text-center">

            <div
                class="mx-auto mb-5 flex size-12 items-center justify-center rounded-xl bg-primary text-primary-foreground shadow-sm"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="size-6"
                >
                    <circle cx="12" cy="12" r="8" />
                    <circle cx="12" cy="12" r="4" />
                    <path d="M4 20 20 4" />
                </svg>
            </div>

            <h1 class="text-2xl font-semibold tracking-tight">
                Archery Scoring
            </h1>

            <p class="mt-2 text-sm text-muted-foreground">
                Admin Management System
            </p>

        </div>

        {{-- Login Card --}}
        <div class="rounded-xl border bg-card p-6 shadow-sm">

            <div class="mb-6 space-y-1.5">
                <h2 class="text-lg font-semibold tracking-tight">
                    Welcome back
                </h2>

                <p class="text-sm text-muted-foreground">
                    Sign in to access the admin dashboard.
                </p>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div
                    class="mb-5 rounded-md border border-destructive/30 bg-destructive/10 px-4 py-3 text-sm text-destructive"
                >
                    {{ $errors->first() }}
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('proses') }}"
                class="space-y-5"
            >

                @csrf

                {{-- Email --}}
                <div class="space-y-2">

                    <x-ui.label for="email">
                        Email
                    </x-ui.label>

                    <x-ui.input
                        name="email"
                        type="email"
                        placeholder="admin@example.com"
                        autocomplete="email"
                        required
                        autofocus
                    />

                    @error('email')
                        <p class="text-sm text-destructive">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Password --}}
                <div class="space-y-2">

                    <x-ui.label for="password">
                        Password
                    </x-ui.label>

                    <x-ui.input
                        name="password"
                        type="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    />

                    @error('password')
                        <p class="text-sm text-destructive">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <x-ui.button type="submit">
                    Sign in
                </x-ui.button>

            </form>

        </div>

        <p class="mt-6 text-center text-xs text-muted-foreground">
            © {{ date('Y') }} Archery Scoring. All rights reserved.
        </p>

    </div>

</div>

@endsection