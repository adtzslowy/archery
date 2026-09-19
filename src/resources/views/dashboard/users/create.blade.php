@extends('layouts.app')

@section('title', 'Create User')

@section('content')

    <div class="mx-auto space-y-6">

        {{-- Header --}}
        <div>

           <a href="{{ route('users.index') }}"
            class="inline-flex items-center gap-2 text-sm text-muted-foreground transition-colors hover:text-foreground"
            >
            <i data-lucide="arrow-left" class="size-4"></i>
            Back to Users
            </a>

            <div class="mt-4">
                <h1 class="text-2xl font-semibold tracking-tight">
                    Create User
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Buat akun baru dan tentukan hak aksesnya.
                </p>
            </div>
        </div>


        {{-- Form --}}
        <div class="rounded-xl border bg-background p-6">

            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Name --}}
                <div class="space-y-2">

                    <label for="name" class="text-sm font-medium">
                        Name
                    </label>

                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                        autocomplete="name"
                        class="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none transition focus:border-foreground"
                        placeholder="John Doe">

                    @error('name')
                        <p class="text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Email --}}
                <div class="space-y-2">

                    <label for="email" class="text-sm font-medium">
                        Email
                    </label>

                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        autocomplete="email"
                        class="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none transition focus:border-foreground"
                        placeholder="john@example.com">

                    @error('email')
                        <p class="text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Role --}}
                <div class="space-y-2">

                    <label for="role" class="text-sm font-medium">
                        Role
                    </label>

                    <select id="role" name="role" required
                        class="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none transition focus:border-foreground">
                        <option value="">Select role</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>

                    @error('role')
                        <p class="text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Password --}}
                <div class="space-y-2">

                    <label for="password" class="text-sm font-medium">
                        Password
                    </label>

                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        minlength="8"
                        class="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none transition focus:border-foreground"
                        placeholder="Minimum 8 characters">

                    @error('password')
                        <p class="text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Confirm Password --}}
                <div class="space-y-2">

                    <label for="password_confirmation" class="text-sm font-medium">
                        Confirm Password
                    </label>

                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        autocomplete="new-password" minlength="8"
                        class="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none transition focus:border-foreground"
                        placeholder="Repeat password">

                    @error('password_confirmation')
                        <p class="text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 border-t pt-6">


                    <a href="{{ route('users.index') }}"
                        class="rounded-md px-4 py-2 text-sm font-medium text-muted-foreground transition hover:bg-muted hover:text-foreground">
                        Cancel
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-md bg-foreground px-4 py-2 text-sm font-medium text-background transition-opacity hover:opacity-90">
                        <i data-lucide="user-plus" class="size-4"></i>
                        Create User
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
