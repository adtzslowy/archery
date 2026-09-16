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

<body class="min-h-screen  bg-muted/30 text-foreground antialiased">

    <div class="min-h-screen">

        <x-navigation.sidebar />

        <div class="lg:pl-64">

            {{-- Topbar --}}
            <header class="sticky top-0 z-30 flex h-16 items-center border-b bg-background/95 px-6 backdrop-blur">
                <div class="flex flex-1 items-center justify-between">

                    <div>
                        <p class="text-sm font-medium">
                            @yield('title', 'Dashboard')
                        </p>

                        <p class="hidden text-xs text-muted-foreground sm:block">
                            Archery Scoring Management System
                        </p>
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

            {{-- Content --}}
            <main class="p-6 lg:p-8">
                <div class="mx-auto max-w-7xl">
                    @yield('content')
                </div>
            </main>

        </div>

    </div>

</body>

</html>
