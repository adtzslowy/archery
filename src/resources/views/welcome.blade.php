<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Panahan — Archery Competition System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-950 text-zinc-900 antialiased">

    {{-- =========================================================
        NAVBAR
    ========================================================== --}}
    <header class="absolute inset-x-0 top-0 z-50">
        <div class="mx-auto max-w-7xl px-8">
            <nav class="flex h-24 items-center justify-between">

                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-zinc-950">
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

                {{-- Navigation --}}
                <div class="hidden items-center gap-8 md:flex">

                    <a href="#home" class="text-sm font-medium text-white transition hover:text-zinc-300">
                        Home
                    </a>

                    <a href="#about" class="text-sm font-medium text-zinc-300 transition hover:text-white">
                        About
                    </a>

                    <a href="#schedule" class="text-sm font-medium text-zinc-300 transition hover:text-white">
                        Schedule
                    </a>

                    <a href="#gallery" class="text-sm font-medium text-zinc-300 transition hover:text-white">
                        Gallery
                    </a>

                    <a href="#brackets" class="text-sm font-medium text-zinc-300 transition hover:text-white">
                        Brackets
                    </a>

                </div>

                {{-- Login --}}
                <a href="{{ route('login') }}"
                    class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
                    Login
                </a>

            </nav>
        </div>
    </header>


    {{-- =========================================================
        HERO
    ========================================================== --}}
    <section id="home" x-data="{
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
    }" class="relative min-h-screen overflow-hidden bg-zinc-950">

        {{-- Background --}}
        <template x-for="(slide, index) in slides" :key="slide">
            <div x-show="active === index" x-transition:enter="transition-opacity duration-1000"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-1000" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0">
                <img :src="slide" alt="Archery Competition" class="h-full w-full object-cover">
            </div>
        </template>

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/55"></div>

        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/20"></div>

        {{-- Content --}}
        <div class="relative z-10 mx-auto flex min-h-screen max-w-7xl items-center px-8">

            <div class="max-w-3xl">

                <h1 class="text-7xl font-bold leading-[0.95] tracking-tight text-white">
                    Every Shot
                    <br>

                    <span class="text-zinc-300">
                        Counts.
                    </span>
                </h1>

                <p class="mt-8 max-w-2xl text-lg leading-8 text-zinc-300">
                    Sistem informasi untuk mengelola peserta,
                    kompetisi, pertandingan, scoring, dan hasil
                    pertandingan panahan dalam satu platform.
                </p>

                <div class="mt-10 flex items-center gap-4">

                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-semibold text-zinc-950 transition hover:bg-zinc-200">
                        Masuk ke Sistem

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </a>

                    <a href="#schedule"
                        class="rounded-xl border border-white/20 bg-white/10 px-6 py-3.5 text-sm font-medium text-white backdrop-blur-md transition hover:bg-white/20">
                        Lihat Jadwal
                    </a>

                </div>

            </div>

        </div>

        {{-- Slider Indicator --}}
        <div class="absolute bottom-10 left-1/2 z-20 flex -translate-x-1/2 items-center gap-2">

            <template x-for="(slide, index) in slides" :key="index">
                <button type="button" @click="active = index" class="h-1.5 rounded-full transition-all duration-300"
                    :class="active === index ?
                        'w-10 bg-white' :
                        'w-5 bg-white/40 hover:bg-white/70'"></button>
            </template>

        </div>

        {{-- Scroll --}}
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
    <section id="about" class="bg-white py-32">
        <div class="mx-auto max-w-7xl px-8">

            <div class="grid grid-cols-12 gap-16">

                <div class="col-span-5">

                    <p class="text-xs font-semibold tracking-[0.25em] text-zinc-400">
                        ABOUT THE SYSTEM
                    </p>

                    <h2 class="mt-5 text-5xl font-bold leading-tight tracking-tight text-zinc-950">
                        Satu sistem untuk
                        <span class="text-zinc-400">
                            setiap pertandingan.
                        </span>
                    </h2>

                </div>

                <div class="col-span-7">

                    <p class="text-lg leading-8 text-zinc-600">
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

                    <div class="mt-12 grid grid-cols-3 gap-6 border-t border-zinc-200 pt-8">

                        <div>
                            <p class="text-3xl font-bold text-zinc-950">
                                01
                            </p>

                            <p class="mt-2 text-sm text-zinc-500">
                                Participant Management
                            </p>
                        </div>

                        <div>
                            <p class="text-3xl font-bold text-zinc-950">
                                02
                            </p>

                            <p class="mt-2 text-sm text-zinc-500">
                                Match Management
                            </p>
                        </div>

                        <div>
                            <p class="text-3xl font-bold text-zinc-950">
                                03
                            </p>

                            <p class="mt-2 text-sm text-zinc-500">
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
    <section id="schedule" class="bg-zinc-50 py-32">
        <div class="mx-auto max-w-7xl px-8">

            <div class="flex items-end justify-between">

                <div>

                    <p class="text-xs font-semibold tracking-[0.25em] text-zinc-400">
                        COMPETITION
                    </p>

                    <h2 class="mt-4 text-5xl font-bold tracking-tight text-zinc-950">
                        Jadwal Kompetisi
                    </h2>

                    <p class="mt-5 max-w-xl text-zinc-500">
                        Lihat jadwal kompetisi dan pertandingan
                        yang akan berlangsung.
                    </p>

                </div>

                <a href="{{ route('login') }}"
                    class="hidden items-center gap-2 text-sm font-semibold text-zinc-900 transition hover:text-zinc-500 md:flex">
                    Kelola Kompetisi

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>

                </a>

            </div>


            <div class="mt-16 grid grid-cols-3 gap-6">

                @foreach ([
        [
            'month' => 'SEP',
            'day' => '21',
            'title' => 'Archery Competition',
            'category' => 'Recurve',
            'location' => 'Main Field',
        ],
        [
            'month' => 'SEP',
            'day' => '24',
            'title' => 'Archery Championship',
            'category' => 'Compound',
            'location' => 'Main Field',
        ],
        [
            'month' => 'OCT',
            'day' => '05',
            'title' => 'Open Archery',
            'category' => 'Open',
            'location' => 'Main Field',
        ],
    ] as $competition)
                    <article
                        class="group rounded-2xl border border-zinc-200 bg-white p-7 transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">
                                    Upcoming
                                </p>

                                <h3 class="mt-4 text-xl font-bold text-zinc-950">
                                    {{ $competition['title'] }}
                                </h3>

                            </div>

                            <div class="rounded-xl bg-zinc-100 px-3 py-2 text-center">

                                <p class="text-xs text-zinc-500">
                                    {{ $competition['month'] }}
                                </p>

                                <p class="text-xl font-bold text-zinc-950">
                                    {{ $competition['day'] }}
                                </p>

                            </div>

                        </div>

                        <div class="mt-8 space-y-3 border-t border-zinc-100 pt-6">

                            <div class="flex justify-between text-sm">

                                <span class="text-zinc-400">
                                    Category
                                </span>

                                <span class="font-medium text-zinc-700">
                                    {{ $competition['category'] }}
                                </span>

                            </div>

                            <div class="flex justify-between text-sm">

                                <span class="text-zinc-400">
                                    Location
                                </span>

                                <span class="font-medium text-zinc-700">
                                    {{ $competition['location'] }}
                                </span>

                            </div>

                        </div>

                    </article>
                @endforeach

            </div>

        </div>
    </section>


    {{-- =========================================================
        GALLERY
    ========================================================== --}}
    <section id="gallery" class="bg-white py-32">
        <div class="mx-auto max-w-7xl px-8">

            <div>

                <p class="text-xs font-semibold tracking-[0.25em] text-zinc-400">
                    MOMENTS
                </p>

                <h2 class="mt-4 text-5xl font-bold tracking-tight text-zinc-950">
                    Gallery
                </h2>

                <p class="mt-5 max-w-xl text-zinc-500">
                    Dokumentasi kegiatan dan pertandingan panahan.
                </p>

            </div>


            <div class="mt-16 grid h-[720px] grid-cols-4 grid-rows-2 gap-4">

                <div class="col-span-2 row-span-2 overflow-hidden rounded-2xl bg-zinc-100">

                    <img src="{{ asset('images/gallery/gallery-1.jpg') }}" alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

                <div class="overflow-hidden rounded-2xl bg-zinc-100">

                    <img src="{{ asset('images/gallery/gallery-2.jpg') }}" alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

                <div class="overflow-hidden rounded-2xl bg-zinc-100">

                    <img src="{{ asset('images/gallery/gallery-3.jpg') }}" alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

                <div class="overflow-hidden rounded-2xl bg-zinc-100">

                    <img src="{{ asset('images/gallery/gallery-4.jpg') }}" alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

                <div class="overflow-hidden rounded-2xl bg-zinc-100">

                    <img src="{{ asset('images/gallery/gallery-5.jpg') }}" alt="Archery Gallery"
                        class="h-full w-full object-cover transition duration-700 hover:scale-105">

                </div>

            </div>

        </div>
    </section>


    {{-- =========================================================
        BRACKETS & POINTS
    ========================================================== --}}
    <section id="brackets" x-data="{
        selectedCategory: '50M',
    
        categories: [
            '5M',
            '10M',
            '15M',
            '20M',
            '30M',
            '40M',
            '50M'
        ],
    
        matches: {
            '5M': [{
                    round: 'Quarter Final',
                    player1: 'Andi Pratama',
                    score1: 58,
                    player2: 'Budi Santoso',
                    score2: 52
                },
                {
                    round: 'Quarter Final',
                    player1: 'Rian Saputra',
                    score1: 55,
                    player2: 'Dimas Putra',
                    score2: 49
                }
            ],
    
            '10M': [{
                    round: 'Quarter Final',
                    player1: 'Fajar Ramadhan',
                    score1: 57,
                    player2: 'Rizky Maulana',
                    score2: 53
                },
                {
                    round: 'Quarter Final',
                    player1: 'Arif Hidayat',
                    score1: 51,
                    player2: 'Bagas Pratama',
                    score2: 48
                }
            ],
    
            '15M': [{
                    round: 'Quarter Final',
                    player1: 'Doni Saputra',
                    score1: 59,
                    player2: 'Raka Wijaya',
                    score2: 54
                },
                {
                    round: 'Quarter Final',
                    player1: 'Yoga Pratama',
                    score1: 52,
                    player2: 'Rian Hidayat',
                    score2: 50
                }
            ],
    
            '20M': [{
                    round: 'Quarter Final',
                    player1: 'Aldi Saputra',
                    score1: 58,
                    player2: 'Fikri Ramadhan',
                    score2: 56
                },
                {
                    round: 'Quarter Final',
                    player1: 'Daffa Putra',
                    score1: 54,
                    player2: 'Rizal Hidayat',
                    score2: 51
                }
            ],
    
            '30M': [{
                    round: 'Quarter Final',
                    player1: 'Kevin Pratama',
                    score1: 60,
                    player2: 'Rangga Saputra',
                    score2: 55
                },
                {
                    round: 'Quarter Final',
                    player1: 'Ilham Putra',
                    score1: 53,
                    player2: 'Bayu Ramadhan',
                    score2: 50
                }
            ],
    
            '40M': [{
                    round: 'Quarter Final',
                    player1: 'Aditya Pratama',
                    score1: 59,
                    player2: 'Rizky Saputra',
                    score2: 57
                },
                {
                    round: 'Quarter Final',
                    player1: 'Fauzan Hidayat',
                    score1: 55,
                    player2: 'Dimas Saputra',
                    score2: 52
                }
            ],
    
            '50M': [{
                    round: 'Quarter Final',
                    player1: 'Andi Pratama',
                    score1: 58,
                    player2: 'Budi Santoso',
                    score2: 52
                },
                {
                    round: 'Quarter Final',
                    player1: 'Rian Saputra',
                    score1: 55,
                    player2: 'Dimas Putra',
                    score2: 49
                },
                {
                    round: 'Quarter Final',
                    player1: 'Fajar Ramadhan',
                    score1: 57,
                    player2: 'Rizky Maulana',
                    score2: 53
                },
                {
                    round: 'Quarter Final',
                    player1: 'Arif Hidayat',
                    score1: 51,
                    player2: 'Bagas Pratama',
                    score2: 48
                }
            ]
        }
    }" class="overflow-hidden bg-zinc-950 py-32 text-white">

        <div class="mx-auto max-w-7xl px-8">

            {{-- Section Header --}}
            <div class="flex items-end justify-between">

                <div>

                    <p class="text-xs font-semibold tracking-[0.25em] text-zinc-500">
                        MATCH SYSTEM
                    </p>

                    <h2 class="mt-4 text-5xl font-bold tracking-tight">
                        Brackets & Points
                    </h2>

                    <p class="mt-5 max-w-2xl leading-7 text-zinc-400">
                        Lihat perkembangan pertandingan berdasarkan
                        kategori jarak lomba.
                    </p>

                </div>

                <div class="hidden text-right lg:block">

                    <p class="text-xs uppercase tracking-[0.2em] text-zinc-500">
                        Current Category
                    </p>

                    <p class="mt-2 text-3xl font-bold" x-text="selectedCategory"></p>

                </div>

            </div>


            {{-- Category Selector --}}
            <div class="mt-12 flex flex-wrap gap-2">

                <template x-for="category in categories" :key="category">

                    <button type="button" @click="selectedCategory = category"
                        class="rounded-xl border px-5 py-3 text-sm font-semibold transition"
                        :class="selectedCategory === category ?
                            'border-white bg-white text-zinc-950' :
                            'border-white/10 bg-white/[0.04] text-zinc-400 hover:border-white/30 hover:text-white'">
                        <span x-text="category"></span>
                    </button>

                </template>

            </div>


            {{-- Bracket --}}
            <div class="mt-12 rounded-3xl border border-white/10 bg-white/[0.03] p-8 lg:p-10">

                {{-- Bracket Header --}}
                <div class="flex items-center justify-between border-b border-white/10 pb-6">

                    <div>

                        <p class="text-xs uppercase tracking-[0.2em] text-zinc-500">
                            Competition Category
                        </p>

                        <h3 class="mt-2 text-2xl font-bold" x-text="selectedCategory + ' Archery'"></h3>

                    </div>

                    <div class="rounded-full border border-white/10 px-4 py-2 text-xs text-zinc-400">
                        Quarter Final
                    </div>

                </div>


                {{-- Bracket Content --}}
                <div class="mt-10 overflow-x-auto">

                    <div class="min-w-[1000px]">

                        <div class="grid grid-cols-[1fr_80px_1fr_80px_1fr] items-center gap-6">

                            {{-- Quarter Final --}}
                            <div>

                                <div class="mb-6">
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-zinc-500">
                                        Quarter Final
                                    </p>
                                </div>

                                <div class="space-y-6">

                                    <template x-for="(match, index) in matches[selectedCategory]"
                                        :key="index">

                                        <div class="space-y-2">

                                            {{-- Player 1 --}}
                                            <div
                                                class="rounded-xl border border-white/10 bg-white/[0.04] p-4 transition hover:border-white/20">

                                                <div class="flex items-center justify-between gap-4">

                                                    <div>
                                                        <p class="font-semibold text-white" x-text="match.player1">
                                                        </p>

                                                        <p class="mt-1 text-xs text-zinc-500">
                                                            Participant
                                                        </p>
                                                    </div>

                                                    <span class="text-xl font-bold" x-text="match.score1"></span>

                                                </div>

                                            </div>


                                            {{-- Player 2 --}}
                                            <div
                                                class="rounded-xl border border-white/10 bg-white/[0.04] p-4 transition hover:border-white/20">

                                                <div class="flex items-center justify-between gap-4">

                                                    <div>
                                                        <p class="font-semibold text-white" x-text="match.player2">
                                                        </p>

                                                        <p class="mt-1 text-xs text-zinc-500">
                                                            Participant
                                                        </p>
                                                    </div>

                                                    <span class="text-xl font-bold" x-text="match.score2"></span>

                                                </div>

                                            </div>

                                        </div>

                                    </template>

                                </div>

                            </div>


                            {{-- Connector --}}
                            <div class="flex flex-col items-center justify-center gap-20">

                                <div class="h-px w-full bg-white/10"></div>
                                <div class="h-px w-full bg-white/10"></div>

                            </div>


                            {{-- Semi Final --}}
                            <div>

                                <div class="mb-6">

                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-zinc-500">
                                        Semi Final
                                    </p>

                                </div>

                                <div class="space-y-20">

                                    <div class="rounded-xl border border-white/10 bg-white/[0.06] p-4">

                                        <div class="flex items-center justify-between">

                                            <div>
                                                <p class="font-semibold text-zinc-300">
                                                    Winner QF 01
                                                </p>

                                                <p class="mt-1 text-xs text-zinc-500">
                                                    TBD
                                                </p>
                                            </div>

                                            <span class="text-xl font-bold text-zinc-500">
                                                —
                                            </span>

                                        </div>

                                    </div>


                                    <div class="rounded-xl border border-white/10 bg-white/[0.06] p-4">

                                        <div class="flex items-center justify-between">

                                            <div>
                                                <p class="font-semibold text-zinc-300">
                                                    Winner QF 02
                                                </p>

                                                <p class="mt-1 text-xs text-zinc-500">
                                                    TBD
                                                </p>
                                            </div>

                                            <span class="text-xl font-bold text-zinc-500">
                                                —
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Connector --}}
                            <div class="flex flex-col items-center justify-center">

                                <div class="h-px w-full bg-white/10"></div>

                            </div>


                            {{-- Final --}}
                            <div>

                                <div class="mb-6">

                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-zinc-500">
                                        Final
                                    </p>

                                </div>

                                <div class="rounded-2xl border border-white/20 bg-white p-6 text-zinc-950">

                                    <div class="flex items-center justify-between">

                                        <div>

                                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">
                                                Championship
                                            </p>

                                            <p class="mt-3 text-lg font-bold">
                                                TBD
                                            </p>

                                        </div>

                                        <div class="text-right">

                                            <p class="text-xs text-zinc-400">
                                                Score
                                            </p>

                                            <p class="mt-1 text-3xl font-bold">
                                                —
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Points --}}
            <div class="mt-8 grid gap-8 lg:grid-cols-3">

                {{-- Description --}}
                <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-8">

                    <p class="text-xs uppercase tracking-[0.2em] text-zinc-500">
                        Scoring
                    </p>

                    <h3 class="mt-3 text-xl font-semibold">
                        Points System
                    </h3>

                    <p class="mt-4 text-sm leading-6 text-zinc-500">
                        Nilai setiap anak panah dihitung berdasarkan
                        posisi pada target.
                    </p>

                </div>


                {{-- Points --}}
                <div class="lg:col-span-2">

                    <div class="grid grid-cols-8 gap-3">

                        @foreach (['X', '10', '9', '8', '7', '6', '5', 'M'] as $point)
                            <div
                                class="flex aspect-square items-center justify-center rounded-2xl border border-white/10 bg-white/[0.04] text-2xl font-bold transition duration-300 hover:border-white/30 hover:bg-white hover:text-zinc-950">
                                {{ $point }}
                            </div>
                        @endforeach

                    </div>

                    <div class="mt-5 flex items-center justify-between border-t border-white/10 pt-5">

                        <span class="text-sm text-zinc-500">
                            Example maximum score
                        </span>

                        <span class="text-2xl font-bold">
                            60
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        CTA
    ========================================================== --}}
    <section class="bg-white py-28">

        <div class="mx-auto max-w-5xl px-8 text-center">

            <p class="text-xs font-semibold tracking-[0.25em] text-zinc-400">
                READY TO COMPETE?
            </p>

            <h2 class="mt-5 text-5xl font-bold tracking-tight text-zinc-950">

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

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>

            </a>

        </div>

    </section>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <footer class="border-t border-zinc-200 bg-white">

        <div class="mx-auto max-w-7xl px-8">

            <div class="flex items-center justify-between py-8">

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
