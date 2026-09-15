@props(['paginator'])

@if ($paginator->hasPages())
    <div class="flex flex-col gap-4 border-t px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

        {{-- Result Information --}}
        <p class="text-sm text-muted-foreground">
            Showing
            <span class="font-medium text-foreground">
                {{ $paginator->firstItem() }}
            </span>
            to
            <span class="font-medium text-foreground">
                {{ $paginator->lastItem() }}
            </span>
            of
            <span class="font-medium text-foreground">
                {{ $paginator->total() }}
            </span>
            results
        </p>

        {{-- Pagination --}}
        <nav class="flex items-center gap-1" aria-label="Pagination">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex size-9 items-center justify-center rounded-md text-muted-foreground/40"
                    aria-disabled="true">
                    <i data-lucide="chevron-left" class="size-4"></i>

                    <span class="sr-only">
                        Previous
                    </span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="inline-flex size-9 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                    aria-label="Previous page">
                    <i data-lucide="chevron-left" class="size-4"></i>

                    <span class="sr-only">
                        Previous
                    </span>
                </a>
            @endif


            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                {{-- Three Dots --}}
                @if (is_string($element))
                    <span class="inline-flex size-9 items-center justify-center text-sm text-muted-foreground">
                        {{ $element }}
                    </span>
                @endif


                {{-- Array Of Pages --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="inline-flex size-9 items-center justify-center rounded-md bg-primary text-sm font-medium text-primary-foreground"
                                aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="inline-flex size-9 items-center justify-center rounded-md text-sm text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                                aria-label="Go to page {{ $page }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach


            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="inline-flex size-9 items-center justify-center rounded-md text-muted-foreground transition-colors hover:bg-accent hover:text-accent-foreground"
                    aria-label="Next page">
                    <i data-lucide="chevron-right" class="size-4"></i>

                    <span class="sr-only">
                        Next
                    </span>
                </a>
            @else
                <span class="inline-flex size-9 items-center justify-center rounded-md text-muted-foreground/40"
                    aria-disabled="true">
                    <i data-lucide="chevron-right" class="size-4"></i>

                    <span class="sr-only">
                        Next
                    </span>
                </span>
            @endif

        </nav>

    </div>
@endif
