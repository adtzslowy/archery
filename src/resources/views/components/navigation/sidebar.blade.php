<aside class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r bg-background lg:flex lg:flex-col">
    {{-- =========================================================
        LOGO / BRAND
    ========================================================== --}}

    <div class="flex h-16 items-center border-b px-6">

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

    </div>


    {{-- =========================================================
        NAVIGATION
    ========================================================== --}}

    <nav class="flex-1 overflow-y-auto px-3 py-4">

        <div class="space-y-1">


            {{-- =====================================================
                DASHBOARD
            ====================================================== --}}

            <a href="{{ route('dashboard') }}"
                class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors
                {{ request()->routeIs('dashboard')
                    ? 'bg-muted text-foreground'
                    : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                <i data-lucide="layout-dashboard" class="size-4 shrink-0"></i>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- =====================================================
                MANAGEMENT
            ====================================================== --}}

            <div class="pt-5">

                <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-wider text-muted-foreground">
                    Management
                </p>


                {{-- =================================================
                    PARTICIPANTS
                ================================================== --}}

                <a href="{{ route('partisipan.index') }}"
                    class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors
                    {{ request()->routeIs('partisipan.*')
                        ? 'bg-muted text-foreground'
                        : 'text-muted-foreground hover:bg-muted/60 hover:text-foreground' }}">

                    <i data-lucide="users" class="size-4 shrink-0"></i>

                    <span>
                        Participants
                    </span>
                </a>


                {{-- =================================================
                    COMPETITION DROPDOWN
                ================================================== --}}

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
                        <a href="{{ route('competition.index') }}"
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


                        {{-- Category --}}
                        <a href="{{ route('category.index') }}"
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

                    </div>

                </details>


                {{-- =================================================
                    MATCH DROPDOWN
                ================================================== --}}

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
                        <a href="{{ route('match.index') }}"
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


                        {{-- Match Setup --}}
                        <a href="{{ route('match-setup.index') }}"
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

                        {{-- Scoring --}}
                        <a href="{{ route('scoring.index') }}"
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

                    </div>

                </details>


                {{-- =================================================
                    RESULT DROPDOWN
                ================================================== --}}

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

                        <a href="{{ route('result.index') }}"
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

            </div>

        </div>

    </nav>


    {{-- =========================================================
        USER / FOOTER
    ========================================================== --}}

    <div class="border-t p-3">

        <div class="flex items-center gap-3 rounded-md px-3 py-2">

            <div class="flex size-9 items-center justify-center rounded-full bg-muted font-medium">

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

        </div>

    </div>

</aside>
