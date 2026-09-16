<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <title>
        @yield('title', 'Dashboard') · Archery Scoring
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans bg-background text-foreground antialiased">

    <div x-data="{ mobileMenuOpen: false }" @keydown.escape.window="mobileMenuOpen = false" class="min-h-screen">

        <x-navigation.sidebar />

        <x-navigation.mobile-sidebar />

        <div class="lg:pl-64">

            {{-- Topbar --}}
            <header class="sticky top-0 z-30 flex h-16 items-center border-b bg-background/95 px-4 backdrop-blur sm:px-6">
                <div class="flex flex-1 items-center justify-between">

                    <div class="flex items-center gap-3">

                        <button type="button" @click="mobileMenuOpen = true" class="inline-flex size-9 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground sm:hidden">
                            <i data-lucide="menu" class="size-5"></i>
                            <span class="sr-only">Open menu</span>
                        </button>

                        <div>
                            <p class="text-sm font-medium">
                                @yield('title', 'Dashboard')
                            </p>

                            <p class="hidden text-xs text-muted-foreground sm:block">
                                Archery Scoring Management System
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center gap-3">

                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-medium">
                                Administrator
                            </p>

                            <p class="text-xs text-muted-foreground">
                                Admin
                            </p>
                        </div>

                        <div
                            class="flex size-9 items-center justify-center rounded-full border bg-muted text-sm font-medium">
                            A
                        </div>

                    </div>

                </div>
            </header>

            {{-- Overlay --}}
            <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm transition-opacity lg:hidden" x-cloak></div>

            {{-- Content --}}
            <main class="p-4 lg:p-6 xl:p-8">
                <div class="mx-auto max-w-7xl">
                    @yield('content')
                </div>
            </main>

        </div>

    </div>

</body>

</html>
