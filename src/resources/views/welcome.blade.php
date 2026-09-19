<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Panahan — Archery Competition System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden bg-zinc-950 text-zinc-900 antialiased">

    {{-- =========================================================
       NAVBAR
    ========================================================== --}}

    <header class="absolute inset-x-0 top-0 z-50" x-data="{ menuOpen: false }">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <nav class="flex h-20 items-center justify-between md:h-24">

                {{-- Logo --}}
                <a href="{{ route('landing.home') }}" class="flex items-center gap-3">

                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-white text-zinc-950 md:h-10 md:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M14 5l7 7-7 7" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-bold tracking-wide text-white">
                            PANAHAN
                        </p>

                        <p class="text-[10px] tracking-[0.2em] text-zinc-400">
                            ARCHERY SYSTEM
                        </p>
                    </div>

                </a>


                {{-- Desktop Navigation --}}
                <div class="hidden items-center gap-8 md:flex">

                    <a href="{{ route('landing.home') }}#home"
                        class="text-sm font-medium text-white transition hover:text-zinc-300">
                        Home
                    </a>

                    <a href="{{ route('landing.about') }}#about"
                        class="text-sm font-medium text-zinc-300 transition hover:text-white">
                        About
                    </a>

                    <a href="{{ route('landing.schedule') }}#schedule"
                        class="text-sm font-medium text-zinc-300 transition hover:text-white">
                        Schedule
                    </a>

                    <a href="{{ route('landing.home') }}#gallery"
                        class="text-sm font-medium text-zinc-300 transition hover:text-white">
                        Gallery
                    </a>

                    <a href="{{ route('landing.brackets') }}#brackets"
                        class="text-sm font-medium text-zinc-300 transition hover:text-white">
                        Brackets
                    </a>

                </div>


                {{-- Login + Mobile Button --}}
                <div class="flex items-center gap-3">

                    <a href="{{ route('login') }}"
                        class="hidden rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200 md:inline-flex">
                        Login
                    </a>

                    <button type="button" @click="menuOpen = !menuOpen"
                        class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-white backdrop-blur-md md:hidden"
                        aria-label="Toggle menu">

                        <svg x-show="!menuOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        <svg x-show="menuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                    </button>

                </div>

            </nav>


            {{-- Mobile Navigation --}}
            <div x-show="menuOpen" x-cloak x-transition @click.outside="menuOpen = false"
                class="mb-4 flex flex-col gap-1 rounded-2xl border border-white/10 bg-zinc-950/95 p-4 backdrop-blur-md md:hidden">

                <a href="{{ route('landing.home') }}#home" @click="menuOpen = false"
                    class="rounded-lg px-3 py-2.5 text-sm font-medium text-white transition hover:bg-white/10">
                    Home
                </a>

                <a href="{{ route('landing.about') }}#about" @click="menuOpen = false"
                    class="rounded-lg px-3 py-2.5 text-sm font-medium text-zinc-300 transition hover:bg-white/10 hover:text-white">
                    About
                </a>

                <a href="{{ route('landing.schedule') }}#schedule" @click="menuOpen = false"
                    class="rounded-lg px-3 py-2.5 text-sm font-medium text-zinc-300 transition hover:bg-white/10 hover:text-white">
                    Schedule
                </a>

                <a href="{{ route('landing.home') }}#gallery" @click="menuOpen = false"
                    class="rounded-lg px-3 py-2.5 text-sm font-medium text-zinc-300 transition hover:bg-white/10 hover:text-white">
                    Gallery
                </a>

                <a href="{{ route('landing.brackets') }}#brackets" @click="menuOpen = false"
                    class="rounded-lg px-3 py-2.5 text-sm font-medium text-zinc-300 transition hover:bg-white/10 hover:text-white">
                    Brackets
                </a>

                <a href="{{ route('login') }}"
                    class="mt-2 rounded-xl bg-white px-5 py-2.5 text-center text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
                    Login
                </a>

            </div>

        </div>

    </header>


    {{-- =========================================================
       HERO
    ========================================================== --}}

    <section id="home"
        x-data="{
            active: 0,
            slides: [
                '{{ asset('images/hero/hero-1.jpeg') }}',
                '{{ asset('images/hero/hero-2.jpeg') }}',
                '{{ asset('images/hero/hero-3.jpeg') }}'
            ],
            init() {
                setInterval(() => {
                    this.active = (this.active + 1) % this.slides.length
                }, 5000)
            }
        }"
        class="relative min-h-screen overflow-hidden bg-zinc-950">

        {{-- Background --}}
        <template x-for="(slide, index) in slides" :key="slide">

            <div x-show="active === index"
                x-transition:enter="transition-opacity duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0">

                <img :src="slide"
                    alt="Archery Competition"
                    class="h-full w-full object-cover">

            </div>

        </template>

        <div class="absolute inset-0 bg-black/55"></div>

        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/20"></div>


        {{-- Hero Content --}}
        <div class="relative z-10 mx-auto flex min-h-screen max-w-7xl items-center px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl">

                <h1
                    class="text-4xl font-bold leading-[1.05] tracking-tight text-white sm:text-5xl md:text-6xl lg:text-7xl">

                    Every Shot
                    <br>

                    <span class="text-zinc-300">
                        Counts.
                    </span>

                </h1>

                <p class="mt-6 max-w-2xl text-base leading-7 text-zinc-300 sm:mt-8 sm:text-lg sm:leading-8">
                    Sistem informasi untuk mengelola peserta,
                    kompetisi, pertandingan, scoring, dan hasil
                    pertandingan panahan dalam satu platform.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:mt-10 sm:flex-row sm:items-center sm:gap-4">

                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">

                        Masuk ke Sistem

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>

                    </a>

                    <a href="#schedule"
                        class="rounded-xl border border-white/20 bg-white/10 px-6 py-3.5 text-center text-sm font-medium text-white backdrop-blur-md transition hover:bg-white/20">
                        Lihat Jadwal
                    </a>

                </div>

            </div>

        </div>


        {{-- Slider Indicator --}}
        <div class="absolute bottom-8 left-1/2 z-20 flex -translate-x-1/2 items-center gap-2 sm:bottom-10">

            <template x-for="(slide, index) in slides" :key="index">

                <button type="button"
                    @click="active = index"
                    class="h-1.5 rounded-full transition-all duration-300"
                    :class="active === index ?
                        'w-10 bg-white' :
                        'w-5 bg-white/40 hover:bg-white/70'">
                </button>

            </template>

        </div>


        <div class="absolute bottom-10 right-8 z-20 hidden items-center gap-3 text-white/60 lg:flex">

            <span class="text-[10px] uppercase tracking-[0.25em]">
                Scroll to explore
            </span>

            <div class="h-10 w-px bg-white/30"></div>

        </div>

    </section>


    {{-- =========================================================
       ABOUT
    ========================================================== --}}

    <section id="about" class="bg-white py-20 sm:py-28 lg:py-32">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-10 lg:grid-cols-12 lg:gap-16">

                <div class="lg:col-span-5">

                    <p class="text-xs font-semibold tracking-[0.25em] text-zinc-400">
                        ABOUT THE SYSTEM
                    </p>

                    <h2
                        class="mt-5 text-3xl font-bold leading-tight tracking-tight text-zinc-950 sm:text-4xl lg:text-5xl">

                        Satu sistem untuk

                        <span class="text-zinc-400">
                            setiap pertandingan.
                        </span>

                    </h2>

                </div>


                <div class="lg:col-span-7">

                    <p class="text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8">
                        Panahan merupakan sistem informasi yang dirancang
                        untuk membantu proses pengelolaan pertandingan
                        panahan secara lebih terstruktur.
                    </p>

                    <p class="mt-6 text-base leading-7 text-zinc-500">
                        Mulai dari pengelolaan peserta, kategori kompetisi,
                        penyusunan pertandingan, proses scoring hingga
                        penyajian hasil pertandingan dapat dilakukan
                        melalui satu sistem.
                    </p>

                    <div class="mt-10 grid grid-cols-3 gap-4 border-t border-zinc-200 pt-8 sm:mt-12 sm:gap-6">

                        <div>
                            <p class="text-2xl font-bold text-zinc-950 sm:text-3xl">
                                01
                            </p>

                            <p class="mt-2 text-xs text-zinc-500 sm:text-sm">
                                Participant Management
                            </p>
                        </div>

                        <div>
                            <p class="text-2xl font-bold text-zinc-950 sm:text-3xl">
                                02
                            </p>

                            <p class="mt-2 text-xs text-zinc-500 sm:text-sm">
                                Match Management
                            </p>
                        </div>

                        <div>
                            <p class="text-2xl font-bold text-zinc-950 sm:text-3xl">
                                03
                            </p>

                            <p class="mt-2 text-xs text-zinc-500 sm:text-sm">
                                Scoring & Result
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
       SCHEDULE
    ========================================================== --}}

    <section id="schedule" class="bg-zinc-50 py-20 sm:py-28 lg:py-32">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">

                <div>

                    <p class="text-xs font-semibold tracking-[0.25em] text-zinc-400">
                        COMPETITION
                    </p>

                    <h2 class="mt-4 text-3xl font-bold tracking-tight text-zinc-950 sm:text-4xl lg:text-5xl">
                        Jadwal Kompetisi
                    </h2>

                    <p class="mt-5 max-w-xl text-zinc-500">
                        Lihat jadwal pertandingan yang akan berlangsung.
                    </p>

                </div>

                <a href="{{ route('login') }}"
                    class="inline-flex w-fit items-center gap-2 text-sm font-semibold text-zinc-900 transition hover:text-zinc-500">

                    Kelola Kompetisi

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>

                </a>

            </div>


            {{-- Schedule List --}}
            <div class="mt-12 grid grid-cols-1 gap-6 sm:mt-16 lg:grid-cols-2">

                @forelse ($matches as $match)

                    <article
                        class="group rounded-2xl border border-zinc-200 bg-white p-5 transition duration-300 hover:-translate-y-1 hover:shadow-xl sm:p-7">

                        <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

                            {{-- Date --}}
                            <div class="flex min-w-0 items-center gap-4">

                                <div
                                    class="flex h-16 w-16 shrink-0 flex-col items-center justify-center rounded-xl bg-zinc-950 text-white">

                                    <p class="text-[10px] font-semibold uppercase tracking-widest text-zinc-400">
                                        {{ $match->scheduled_at?->format('M') }}
                                    </p>

                                    <p class="text-2xl font-bold leading-none">
                                        {{ $match->scheduled_at?->format('d') }}
                                    </p>

                                </div>

                                <div class="min-w-0">

                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">
                                        {{ ucfirst($match->status ?? 'scheduled') }}
                                    </p>

                                    <h3 class="mt-2 break-words text-xl font-bold text-zinc-950">
                                        {{ $match->name }}
                                    </h3>

                                </div>

                            </div>


                            {{-- Time --}}
                            @if ($match->scheduled_at)

                                <div class="text-left sm:text-right">

                                    <p class="text-xs text-zinc-400">
                                        Time
                                    </p>

                                    <p class="mt-1 text-lg font-bold text-zinc-950">
                                        {{ $match->scheduled_at->format('H:i') }}
                                    </p>

                                </div>

                            @endif

                        </div>


                        {{-- Match Info --}}
                        <div class="mt-8 space-y-3 border-t border-zinc-100 pt-6">

                            <div class="flex items-start justify-between gap-4 text-sm">

                                <span class="shrink-0 text-zinc-400">
                                    Competition
                                </span>

                                <span class="max-w-[65%] break-words text-right font-medium text-zinc-700">
                                    {{ $match->competition?->name ?? '—' }}
                                </span>

                            </div>


                            <div class="flex items-start justify-between gap-4 text-sm">

                                <span class="shrink-0 text-zinc-400">
                                    Category
                                </span>

                                <span class="max-w-[65%] rounded-full bg-zinc-100 px-3 py-1 text-right font-medium text-zinc-700">
                                    {{ $match->competition?->category?->name ?? '—' }}
                                </span>

                            </div>


                            <div class="flex items-start justify-between gap-4 text-sm">

                                <span class="shrink-0 text-zinc-400">
                                    Location
                                </span>

                                <span class="max-w-[65%] break-words text-right font-medium text-zinc-700">
                                    {{ $match->location ?? '—' }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between gap-4 text-sm">

                                <span class="text-zinc-400">
                                    Participants
                                </span>

                                <span class="font-medium text-zinc-700">
                                    {{ $match->participants->count() }}
                                </span>

                            </div>

                        </div>

                    </article>

                @empty

                    <div class="sm:col-span-2">

                        <div class="rounded-2xl border border-dashed border-zinc-300 bg-white p-12 text-center">

                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-zinc-100">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" />
                                </svg>

                            </div>

                            <p class="mt-4 text-sm font-semibold text-zinc-700">
                                Belum ada pertandingan terjadwal.
                            </p>

                            <p class="mt-1 text-sm text-zinc-400">
                                Jadwal pertandingan akan muncul di sini.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- =========================================================
       GALLERY
    ========================================================== --}}

    <section id="gallery" class="bg-white py-20 sm:py-28 lg:py-32">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div>

                <p class="text-xs font-semibold tracking-[0.25em] text-zinc-400">
                    MOMENTS
                </p>

                <h2 class="mt-4 text-3xl font-bold tracking-tight text-zinc-950 sm:text-4xl lg:text-5xl">
                    Gallery
                </h2>

                <p class="mt-5 max-w-xl text-zinc-500">
                    Dokumentasi kegiatan dan pertandingan panahan.
                </p>

            </div>


            <div class="mt-12 grid grid-cols-2 gap-3 sm:mt-16 sm:h-[720px] sm:grid-cols-4 sm:grid-rows-2 sm:gap-4">

                <div
                    class="col-span-2 row-span-2 aspect-square overflow-hidden rounded-2xl bg-zinc-100 sm:aspect-auto">

                    <img src="{{ asset('images/hero/hero-1.jpeg') }}"
                        alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

                <div class="aspect-square overflow-hidden rounded-2xl bg-zinc-100 sm:aspect-auto">

                    <img src="{{ asset('images/hero/hero-2.jpeg') }}"
                        alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

                <div class="aspect-square overflow-hidden rounded-2xl bg-zinc-100 sm:aspect-auto">

                    <img src="{{ asset('images/hero/hero-3.jpeg') }}"
                        alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

                <div class="aspect-square overflow-hidden rounded-2xl bg-zinc-100 sm:aspect-auto">

                    <img src="{{ asset('images/hero/hero-1.jpeg') }}"
                        alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

                <div class="aspect-square overflow-hidden rounded-2xl bg-zinc-100 sm:aspect-auto">

                    <img src="{{ asset('images/hero/hero-3.jpeg') }}"
                        alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
       BRACKETS & POINTS
    ========================================================== --}}

    <section id="brackets" class="overflow-hidden bg-zinc-950 py-20 text-white sm:py-28 lg:py-32">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">

                <div class="min-w-0">

                    <p class="text-xs font-semibold tracking-[0.25em] text-zinc-500">
                        MATCH SYSTEM
                    </p>

                    <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">
                        Brackets & Points
                    </h2>

                    <p class="mt-5 max-w-2xl leading-7 text-zinc-400">
                        Lihat perkembangan pertandingan berdasarkan kategori lomba.
                    </p>

                </div>


                @if ($categories->isNotEmpty())

                    <div class="w-fit shrink-0 text-left lg:text-right">

                        <p class="text-xs uppercase tracking-[0.2em] text-zinc-500">
                            Available Categories
                        </p>

                        <p class="mt-2 text-3xl font-bold">
                            {{ $categories->count() }}
                        </p>

                    </div>

                @endif

            </div>


            {{-- Category Selector --}}
            @if ($categories->isNotEmpty())

                <div class="mt-10 -mx-1 flex gap-2 overflow-x-auto px-1 pb-3 scrollbar-none sm:mt-12 sm:mx-0 sm:flex-wrap sm:overflow-visible sm:px-0 sm:pb-0">

                    @foreach ($categories as $category)

                        <a href="#category-{{ $category->id }}"
                            class="shrink-0 rounded-xl border border-white/10 bg-white/[0.04] px-4 py-2.5 text-sm font-semibold text-zinc-400 transition hover:border-white/30 hover:bg-white hover:text-zinc-950 sm:px-5 sm:py-3">

                            {{ $category->name }}

                        </a>

                    @endforeach

                </div>

            @endif


            {{-- =====================================================
                 CATEGORY BRACKETS
            ====================================================== --}}

            @forelse ($categories as $category)

                @php

                    $categoryMatches = $category->competitions
                        ->flatMap(function ($competition) {
                            return $competition->matches;
                        })
                        ->sortBy('scheduled_at');

                @endphp


                <div id="category-{{ $category->id }}"
                    class="mt-8 scroll-mt-24 overflow-hidden rounded-3xl border border-white/10 bg-white/[0.03] p-4 sm:mt-12 sm:p-8 lg:p-10">


                    {{-- Category Header --}}
                    <div
                        class="flex flex-col gap-5 border-b border-white/10 pb-6 sm:flex-row sm:items-center sm:justify-between">

                        <div class="min-w-0">

                            <p class="text-xs uppercase tracking-[0.2em] text-zinc-500">
                                Competition Category
                            </p>

                            <h3 class="mt-2 break-words text-xl font-bold sm:text-2xl">
                                {{ $category->name }}
                            </h3>

                            @if ($category->description)

                                <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-500">
                                    {{ $category->description }}
                                </p>

                            @endif

                        </div>


                        <div
                            class="w-fit shrink-0 rounded-full border border-white/10 px-4 py-2 text-xs text-zinc-400">

                            {{ $categoryMatches->count() }}

                            {{ $categoryMatches->count() === 1 ? 'Match' : 'Matches' }}

                        </div>

                    </div>


                    {{-- Matches --}}
                    @if ($categoryMatches->isNotEmpty())

                        <div class="mt-6 grid gap-5 lg:grid-cols-2 lg:gap-6">

                            @foreach ($categoryMatches as $match)

                                @php

                                    $participantScores = $match->scores
                                        ->groupBy('participant_id')
                                        ->map(function ($scores) {
                                            return $scores->sum('point');
                                        });

                                @endphp


                                <article
                                    class="min-w-0 rounded-2xl border border-white/10 bg-white/[0.03] p-4 transition hover:border-white/20 hover:bg-white/[0.05] sm:p-5">


                                    {{-- Match Header --}}
                                    <div
                                        class="flex flex-col gap-4 border-b border-white/10 pb-4 sm:flex-row sm:items-start sm:justify-between">

                                        <div class="min-w-0">

                                            <p
                                                class="text-[10px] font-semibold uppercase tracking-[0.2em] text-zinc-500">

                                                {{ $match->status ? ucfirst($match->status) : 'Match' }}

                                            </p>

                                            <h4 class="mt-2 break-words text-lg font-bold text-white">

                                                {{ $match->name }}

                                            </h4>

                                            @if ($match->competition)

                                                <p class="mt-1 break-words text-xs text-zinc-500">
                                                    {{ $match->competition->name }}
                                                </p>

                                            @endif

                                        </div>


                                        @if ($match->scheduled_at)

                                            <div class="shrink-0 text-left sm:text-right">

                                                <p class="text-xs text-zinc-500">
                                                    {{ $match->scheduled_at->format('d M Y') }}
                                                </p>

                                                <p class="mt-1 text-sm font-semibold text-zinc-300">
                                                    {{ $match->scheduled_at->format('H:i') }}
                                                </p>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- Participants --}}
                                    @if ($match->participants->isNotEmpty())

                                        <div class="mt-5 space-y-2">

                                            @foreach ($match->participants as $participant)

                                                @php
                                                    $totalScore = $participantScores[$participant->id] ?? 0;
                                                @endphp


                                                <div
                                                    class="flex min-w-0 items-center gap-3 rounded-xl border border-white/10 bg-white/[0.03] p-3 sm:justify-between sm:p-4">


                                                    {{-- Participant --}}
                                                    <div class="flex min-w-0 flex-1 items-center gap-3">

                                                        {{-- Lane --}}
                                                        @if ($participant->pivot?->lane)

                                                            <div
                                                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 text-xs font-bold text-zinc-300">

                                                                {{ $participant->pivot->lane }}

                                                            </div>

                                                        @endif


                                                        <div class="min-w-0">

                                                            <p class="truncate font-semibold text-white">

                                                                {{ $participant->name }}

                                                            </p>

                                                            <p class="mt-1 truncate text-xs text-zinc-500">

                                                                @if ($participant->participant_number)
                                                                    #{{ $participant->participant_number }}
                                                                @else
                                                                    Participant
                                                                @endif

                                                                @if ($participant->school)
                                                                    · {{ $participant->school }}
                                                                @endif

                                                            </p>

                                                        </div>

                                                    </div>


                                                    {{-- Score --}}
                                                    <div class="shrink-0 text-right">

                                                        <p
                                                            class="text-[9px] uppercase tracking-widest text-zinc-500 sm:text-[10px]">
                                                            Score
                                                        </p>

                                                        <p class="mt-1 text-lg font-bold text-white sm:text-xl">
                                                            {{ $totalScore }}
                                                        </p>

                                                    </div>

                                                </div>

                                            @endforeach

                                        </div>

                                    @else

                                        <div
                                            class="mt-5 rounded-xl border border-dashed border-white/10 p-6 text-center">

                                            <p class="text-sm font-medium text-zinc-400">
                                                Belum ada peserta.
                                            </p>

                                            <p class="mt-1 text-xs text-zinc-600">
                                                Peserta pertandingan akan muncul setelah match setup.
                                            </p>

                                        </div>

                                    @endif


                                    {{-- Match Footer --}}
                                    <div
                                        class="mt-5 flex flex-col gap-3 border-t border-white/10 pt-4 text-xs text-zinc-500 sm:flex-row sm:items-center sm:justify-between">

                                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2">

                                            @if ($match->location)

                                                <span class="max-w-full break-words">
                                                    {{ $match->location }}
                                                </span>

                                            @endif

                                            <span>
                                                {{ $match->participants->count() }} peserta
                                            </span>

                                        </div>


                                        @if ($match->scores->isNotEmpty())

                                            <span class="text-zinc-400">
                                                {{ $match->scores->count() }} scoring entries
                                            </span>

                                        @endif

                                    </div>

                                </article>

                            @endforeach

                        </div>

                    @else

                        <div class="mt-6 rounded-2xl border border-dashed border-white/10 p-8 text-center sm:mt-8 sm:p-10">

                            <p class="text-sm font-medium text-zinc-400">
                                Belum ada pertandingan untuk kategori ini.
                            </p>

                            <p class="mt-1 text-xs text-zinc-600">
                                Match akan muncul setelah dibuat melalui dashboard.
                            </p>

                        </div>

                    @endif

                </div>

            @empty

                {{-- No Categories --}}
                <div
                    class="mt-8 rounded-3xl border border-dashed border-white/10 bg-white/[0.02] p-10 text-center sm:mt-12 sm:p-12">

                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>

                    </div>

                    <p class="mt-5 text-sm font-semibold text-zinc-400">
                        Belum ada kategori pertandingan.
                    </p>

                    <p class="mt-1 text-sm text-zinc-600">
                        Kategori lomba akan muncul di sini setelah dibuat melalui dashboard.
                    </p>

                </div>

            @endforelse


            {{-- =====================================================
                 SCORING INFORMATION
            ====================================================== --}}

            <div class="mt-10 grid gap-6 sm:gap-8 lg:grid-cols-3">

                {{-- Description --}}
                <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 sm:p-8">

                    <p class="text-xs uppercase tracking-[0.2em] text-zinc-500">
                        Scoring
                    </p>

                    <h3 class="mt-3 text-xl font-semibold">
                        Points System
                    </h3>

                    <p class="mt-4 text-sm leading-6 text-zinc-500">
                        Nilai setiap anak panah dicatat melalui
                        sistem scoring pertandingan.
                    </p>

                </div>


                {{-- Points --}}
                <div class="lg:col-span-2">

                    <div class="grid grid-cols-4 gap-2 sm:grid-cols-8 sm:gap-3">

                        @foreach (['X', '6', '5', '4', '3', '2', '1', 'M'] as $point)

                            <div
                                class="flex aspect-square items-center justify-center rounded-2xl border border-white/10 bg-white/[0.04] text-lg font-bold transition duration-300 hover:border-white/30 hover:bg-white hover:text-zinc-950 sm:text-2xl">

                                {{ $point }}

                            </div>

                        @endforeach

                    </div>


                    <div class="mt-5 flex items-center justify-between border-t border-white/10 pt-5">

                        <span class="text-sm text-zinc-500">
                            Maximum point per arrow
                        </span>

                        <span class="text-2xl font-bold">
                            6
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
       CTA
    ========================================================== --}}

    <section class="bg-white py-20 sm:py-24 lg:py-28">

        <div class="mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">

            <p class="text-xs font-semibold tracking-[0.25em] text-zinc-400">
                READY TO COMPETE?
            </p>

            <h2 class="mt-5 text-3xl font-bold tracking-tight text-zinc-950 sm:text-4xl lg:text-5xl">

                Every competition starts

                <span class="text-zinc-400">
                    with a single shot.
                </span>

            </h2>

            <p class="mx-auto mt-6 max-w-2xl leading-7 text-zinc-500">
                Kelola pertandingan panahan dengan lebih
                terstruktur melalui Panahan.
            </p>

            <a href="{{ route('login') }}"
                class="mt-10 inline-flex items-center gap-2 rounded-xl bg-zinc-950 px-7 py-3.5 text-sm font-semibold text-white transition hover:bg-zinc-800">

                Masuk ke Sistem

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>

            </a>

        </div>

    </section>


    {{-- =========================================================
       FOOTER
    ========================================================== --}}

    <footer class="border-t border-zinc-200 bg-white">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col items-center gap-2 py-8 text-center sm:flex-row sm:justify-between sm:text-left">

                <div>

                    <p class="text-sm font-bold text-zinc-950">
                        PANAHAN
                    </p>

                    <p class="mt-1 text-xs text-zinc-400">
                        Archery Competition System
                    </p>

                </div>

                <p class="text-xs text-zinc-400">
                    © {{ date('Y') }} Panahan. All rights reserved.
                </p>

            </div>

        </div>

    </footer>

</body>

</html>