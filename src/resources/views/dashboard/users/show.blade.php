@extends('layouts.app')

@section('title', 'Show Users')

@section('content')

    <div class="mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>

                <a
                    href="{{ route('users.index') }}"
                    class="inline-flex items-center gap-2 text-sm text-muted-foreground transition-colors hover:text-foreground"
                >
                    <i data-lucide="arrow-left" class="size-4"></i>
                    Back to Users
                </a>

                <div class="mt-4">

                    <h1 class="text-2xl font-semibold tracking-tight">
                        User Detail
                    </h1>

                    <p class="mt-1 text-sm text-muted-foreground">
                        Informasi akun pengguna.
                    </p>

                </div>

            </div>


            @can('user.update')
                <a
                    href="{{ route('users.edit', $user) }}"
                    class="inline-flex items-center gap-2 rounded-md bg-foreground px-4 py-2 text-sm font-medium text-background transition-opacity hover:opacity-90"
                >
                    <i data-lucide="pencil" class="size-4"></i>
                    Edit User
                </a>
            @endcan

        </div>


        {{-- User Card --}}
        <div class="overflow-hidden rounded-xl border bg-background">

            {{-- Profile --}}
            <div class="flex items-center gap-4 border-b p-6">

                <div class="flex size-14 items-center justify-center rounded-full bg-muted text-lg font-semibold">

                    {{ strtoupper(substr($user->name, 0, 1)) }}

                </div>

                <div class="min-w-0">

                    <h2 class="font-semibold">
                        {{ $user->name }}
                    </h2>

                    <p class="text-sm text-muted-foreground">
                        {{ $user->email }}
                    </p>

                </div>

            </div>


            {{-- Information --}}
            <div class="divide-y">

                {{-- Name --}}
                <div class="flex items-center justify-between px-6 py-4">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Name
                        </p>

                        <p class="mt-1 text-sm font-medium">
                            {{ $user->name }}
                        </p>

                    </div>

                    <i data-lucide="user" class="size-4 text-muted-foreground"></i>

                </div>


                {{-- Email --}}
                <div class="flex items-center justify-between px-6 py-4">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Email
                        </p>

                        <p class="mt-1 text-sm font-medium">
                            {{ $user->email }}
                        </p>

                    </div>

                    <i data-lucide="mail" class="size-4 text-muted-foreground"></i>

                </div>


                {{-- Role --}}
                <div class="flex items-center justify-between px-6 py-4">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Role
                        </p>

                        <div class="mt-2 flex flex-wrap gap-2">

                            @forelse ($user->roles as $role)

                                <span class="inline-flex items-center rounded-md bg-muted px-2.5 py-1 text-xs font-medium">
                                    {{ ucfirst($role->name) }}
                                </span>

                            @empty

                                <span class="text-sm text-muted-foreground">
                                    No role assigned
                                </span>

                            @endforelse

                        </div>

                    </div>

                    <i data-lucide="shield" class="size-4 text-muted-foreground"></i>

                </div>


                {{-- Created --}}
                <div class="flex items-center justify-between px-6 py-4">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Created At
                        </p>

                        <p class="mt-1 text-sm font-medium">
                            {{ $user->created_at?->format('d F Y, H:i') }}
                        </p>

                    </div>

                    <i data-lucide="calendar-plus" class="size-4 text-muted-foreground"></i>

                </div>


                {{-- Updated --}}
                <div class="flex items-center justify-between px-6 py-4">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            Last Updated
                        </p>

                        <p class="mt-1 text-sm font-medium">
                            {{ $user->updated_at?->format('d F Y, H:i') }}
                        </p>

                    </div>

                    <i data-lucide="clock-3" class="size-4 text-muted-foreground"></i>

                </div>

            </div>


            {{-- Danger Zone --}}
            @can('user.delete')

                @if ($user->id !== auth()->id())

                    <div class="border-t p-6">

                        <div class="flex items-center justify-between gap-6">

                            <div>

                                <h3 class="text-sm font-semibold text-red-600">
                                    Delete User
                                </h3>

                                <p class="mt-1 text-xs text-muted-foreground">
                                    User yang dihapus tidak dapat dipulihkan.
                                </p>

                            </div>

                            <form
                                action="{{ route('users.destroy', $user) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-md border border-red-200 px-4 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50 dark:border-red-900 dark:hover:bg-red-950/30"
                                >
                                    <i data-lucide="trash-2" class="size-4"></i>
                                    Delete User
                                </button>

                            </form>

                        </div>

                    </div>

                @endif

            @endcan

        </div>

    </div>

@endsection