<aside
    class="fixed inset-y-0 left-0 z-50 w-64 transform -translate-x-full transition-transform duration-300 ease-in-out bg-background shadow-xl lg:hidden"
    :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'" @keydown.escape.window="mobileMenuOpen = false">

    {{-- =========================================================
         LOGO / BRAND
    ========================================================== --}}

    <div class="flex h-16 items-center justify-between border-b px-6">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">

            <div class="flex size-9 items-center justify-center rounded-lg bg-foreground text-background">
                <i data-lucide="target" class="size-5"></i>
            </div>

            <div class="leading-none">

                <p class="font-semibold tracking-tight">
                    Panahan
                </p>

                <p class="mt-1 text-xs text-muted-foreground">
                    Dashboard
                </p>

            </div>

        </a>

        <button type="button" @click="mobileMenuOpen = false"
            class="inline-flex size-8 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground">
            <i data-lucide="x" class="size-5"></i>
            <span class="sr-only">Close</span>
        </button>

    </div>


    {{-- =========================================================
         NAVIGATION
    ========================================================== --}}

    <nav class="flex-1 overflow-y-auto px-3 py-4">

        <div class="space-y-1">


            {{-- =====================================================
                 DASHBOARD
            ====================================================== --}}

            @can('dashboard.view')
                <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false"
                    class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors
                    {{ request()->routeIs('dashboard')
                        ? 'bg-muted text-foreground'
                        : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                    <i data-lucide="layout-dashboard" class="size-4 shrink-0"></i>

                    <span>
                        Dashboard
                    </span>

                </a>
            @endcan


            {{-- =====================================================
                 MANAGEMENT
            ====================================================== --}}

            @if (auth()->user()->can('participant.view') ||
                    auth()->user()->can('competition.view') ||
                    auth()->user()->can('category.view') ||
                    auth()->user()->can('match.view') ||
                    auth()->user()->can('scoring.view') ||
                    auth()->user()->can('result.view'))

                <div class="pt-5">

                    <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                        Management
                    </p>


                    {{-- =================================================
                         PARTICIPANTS
                    ================================================== --}}

                    @can('participant.view')
                        <a href="{{ route('partisipan.index') }}" @click="mobileMenuOpen = false"
                            class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors
                            {{ request()->routeIs('partisipan.*')
                                ? 'bg-muted text-foreground'
                                : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                            <i data-lucide="users" class="size-4 shrink-0"></i>

                            <span>
                                Participants
                            </span>

                        </a>
                    @endcan


                    {{-- =================================================
                         COMPETITION DROPDOWN
                    ================================================== --}}

                    @if (auth()->user()->can('competition.view') || auth()->user()->can('category.view'))
                        @php
                            $competitionOpen = request()->routeIs('competition.*') || request()->routeIs('category.*');
                        @endphp

                        <details class="group" {{ $competitionOpen ? 'open' : '' }}>

                            <summary
                                class="flex cursor-pointer list-none items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted/60 hover:text-foreground [&::-webkit-details-marker]:hidden">

                                <i data-lucide="trophy" class="size-4 shrink-0"></i>

                                <span class="flex-1">
                                    Competition
                                </span>

                                <i data-lucide="chevron-right"
                                    class="size-4 transition-transform duration-200 group-open:rotate-90"></i>

                            </summary>


                            {{-- SUBMENU --}}

                            <div class="relative ml-5 mt-1 border-l pl-3">

                                {{-- Competition --}}

                                @can('competition.view')
                                    <a href="{{ route('competition.index') }}" @click="mobileMenuOpen = false"
                                        class="relative flex items-center gap-2 rounded-md px-3 py-2 text-sm transition-colors
                                        {{ request()->routeIs('competition.*')
                                            ? 'bg-muted font-medium text-foreground'
                                            : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                                        @if (request()->routeIs('competition.*'))
                                            <span
                                                class="absolute -left-[13px] top-1/2 h-5 w-0.5 -translate-y-1/2 rounded-full bg-foreground"></span>
                                        @endif

                                        <i data-lucide="trophy" class="size-4"></i>

                                        <span>
                                            Competitions
                                        </span>

                                    </a>
                                @endcan


                                {{-- Category --}}

                                @can('category.view')
                                    <a href="{{ route('category.index') }}" @click="mobileMenuOpen = false"
                                        class="relative flex items-center gap-2 rounded-md px-3 py-2 text-sm transition-colors
                                        {{ request()->routeIs('category.*')
                                            ? 'bg-muted font-medium text-foreground'
                                            : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                                        @if (request()->routeIs('category.*'))
                                            <span
                                                class="absolute -left-[13px] top-1/2 h-5 w-0.5 -translate-y-1/2 rounded-full bg-foreground"></span>
                                        @endif

                                        <i data-lucide="tags" class="size-4"></i>

                                        <span>
                                            Categories
                                        </span>

                                    </a>
                                @endcan

                            </div>

                        </details>
                    @endif


                    {{-- =================================================
                         MATCH DROPDOWN
                    ================================================== --}}

                    @if (auth()->user()->can('match.view') || auth()->user()->can('scoring.view'))
                        @php
                            $matchOpen =
                                request()->routeIs('match.*') ||
                                request()->routeIs('match-setup.*') ||
                                request()->routeIs('scoring.*');
                        @endphp

                        <details class="group" {{ $matchOpen ? 'open' : '' }}>

                            <summary
                                class="flex cursor-pointer list-none items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted/60 hover:text-foreground [&::-webkit-details-marker]:hidden">

                                <i data-lucide="target" class="size-4 shrink-0"></i>

                                <span class="flex-1">
                                    Match
                                </span>

                                <i data-lucide="chevron-right"
                                    class="size-4 transition-transform duration-200 group-open:rotate-90"></i>

                            </summary>


                            {{-- SUBMENU --}}

                            <div class="relative ml-5 mt-1 border-l pl-3">

                                {{-- Matches --}}

                                @can('match.view')
                                    <a href="{{ route('match.index') }}" @click="mobileMenuOpen = false"
                                        class="relative flex items-center gap-2 rounded-md px-3 py-2 text-sm transition-colors
                                        {{ request()->routeIs('match.*')
                                            ? 'bg-muted font-medium text-foreground'
                                            : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                                        @if (request()->routeIs('match.*'))
                                            <span
                                                class="absolute -left-[13px] top-1/2 h-5 w-0.5 -translate-y-1/2 rounded-full bg-foreground"></span>
                                        @endif

                                        <i data-lucide="swords" class="size-4"></i>

                                        <span>
                                            Matches
                                        </span>

                                    </a>
                                @endcan


                                {{-- Match Setup --}}

                                @can('match.view')
                                    <a href="{{ route('match-setup.index') }}" @click="mobileMenuOpen = false"
                                        class="relative flex items-center gap-2 rounded-md px-3 py-2 text-sm transition-colors
                                        {{ request()->routeIs('match-setup.*')
                                            ? 'bg-muted font-medium text-foreground'
                                            : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                                        @if (request()->routeIs('match-setup.*'))
                                            <span
                                                class="absolute -left-[13px] top-1/2 h-5 w-0.5 -translate-y-1/2 rounded-full bg-foreground"></span>
                                        @endif

                                        <i data-lucide="users-round" class="size-4"></i>

                                        <span>
                                            Match Setup
                                        </span>

                                    </a>
                                @endcan


                                {{-- Scoring --}}

                                @can('scoring.view')
                                    <a href="{{ route('scoring.index') }}" @click="mobileMenuOpen = false"
                                        class="relative flex items-center gap-2 rounded-md px-3 py-2 text-sm transition-colors
                                        {{ request()->routeIs('scoring.*')
                                            ? 'bg-muted font-medium text-foreground'
                                            : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                                        @if (request()->routeIs('scoring.*'))
                                            <span
                                                class="absolute -left-[13px] top-1/2 h-5 w-0.5 -translate-y-1/2 rounded-full bg-foreground"></span>
                                        @endif

                                        <i data-lucide="clipboard-pen" class="size-4"></i>

                                        <span>
                                            Scoring
                                        </span>

                                    </a>
                                @endcan

                            </div>

                        </details>
                    @endif


                    {{-- =================================================
                         RESULT DROPDOWN
                    ================================================== --}}

                    @can('result.view')
                        @php
                            $resultOpen = request()->routeIs('result.*');
                        @endphp

                        <details class="group" {{ $resultOpen ? 'open' : '' }}>

                            <summary
                                class="flex cursor-pointer list-none items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted/60 hover:text-foreground [&::-webkit-details-marker]:hidden">

                                <i data-lucide="bar-chart-3" class="size-4 shrink-0"></i>

                                <span class="flex-1">
                                    Result
                                </span>

                                <i data-lucide="chevron-right"
                                    class="size-4 transition-transform duration-200 group-open:rotate-90"></i>

                            </summary>


                            {{-- SUBMENU --}}

                            <div class="relative ml-5 mt-1 border-l pl-3">

                                <a href="{{ route('result.index') }}" @click="mobileMenuOpen = false"
                                    class="relative flex items-center gap-2 rounded-md px-3 py-2 text-sm transition-colors
                                    {{ request()->routeIs('result.*')
                                        ? 'bg-muted font-medium text-foreground'
                                        : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                                    @if (request()->routeIs('result.*'))
                                        <span
                                            class="absolute -left-[13px] top-1/2 h-5 w-0.5 -translate-y-1/2 rounded-full bg-foreground"></span>
                                    @endif

                                    <i data-lucide="bar-chart-3" class="size-4"></i>

                                    <span>
                                        Results
                                    </span>

                                </a>

                            </div>

                        </details>
                    @endcan

                </div>

            @endif


            {{-- =====================================================
                 SYSTEM
            ====================================================== --}}

            @can('user.view')
                <div class="pt-5">

                    <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                        System
                    </p>

                    <a href="{{ route('users.index') }}" @click="mobileMenuOpen = false"
                        class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors
                        {{ request()->routeIs('users.*')
                            ? 'bg-muted text-foreground'
                            : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                        <i data-lucide="user-cog" class="size-4 shrink-0"></i>

                        <span>
                            User Management
                        </span>

                    </a>

                </div>
            @endcan


        </div>

    </nav>


    {{-- =========================================================
         USER / FOOTER
    ========================================================== --}}

    {{-- Dropdown --}}
    <div class="border-t p-3" x-data="{ open: false }">

        <div class="relative">

            {{-- Trigger --}}
            <button type="button" @click="open = !open" @click.outside="open = false"
                class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-left transition hover:bg-muted">

                <div class="flex size-9 shrink-0 items-center justify-center rounded-full bg-muted font-medium">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-medium">
                        {{ auth()->user()->name ?? 'User' }}
                    </p>

                    <p class="truncate text-xs text-muted-foreground">
                        {{ auth()->user()->email ?? '' }}
                    </p>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-muted-foreground transition"
                    :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
                </svg>

            </button>

            {{-- Dropdown --}}
            <div x-show="open" x-cloak x-transition
                class="absolute bottom-full left-0 z-50 mb-2 w-full overflow-hidden rounded-md border bg-background shadow-lg">

                <div class="min-w-0 border-b px-3 py-2">
                    <p class="truncate text-sm font-medium">
                        {{ auth()->user()->name ?? 'User' }}
                    </p>

                    <p class="truncate text-xs text-muted-foreground">
                        {{ auth()->user()->email ?? '' }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-2 px-3 py-2 text-left text-sm text-red-600 transition hover:bg-red-50">
                        <i data-lucide="log-out" class="size-4"></i>
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>
</aside>
