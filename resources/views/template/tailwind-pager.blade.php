@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-col items-center space-y-4">

    {{-- Info o stránkách --}}
    <div>
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
            Stránka
            <span class="font-semibold text-gray-800 dark:text-white">
                {{ $paginator->currentPage() }}
            </span>
            z
            <span class="font-semibold text-gray-800 dark:text-white">
                {{ $paginator->lastPage() }}
            </span>
        </p>
    </div>

    {{-- Pagination --}}
    <div class="flex items-center space-x-1">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
        <span class="px-3 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
            ←
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
            class="px-3 py-2 rounded-lg bg-white border hover:bg-gray-100 transition">
            ←
        </a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)

        {{-- dots --}}
        @if (is_string($element))
        <span class="px-3 py-2 text-gray-400">
            {{ $element }}
        </span>
        @endif

        {{-- numbers --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)

        @if ($page == 2 || $page == $paginator->lastPage() - 1)
        @continue
        @endif

        @if ($page == $paginator->currentPage())
        <span class="px-4 py-2 rounded-lg bg-blue-500 text-white font-semibold shadow">
            {{ $page }}
        </span>
        @else
        <a href="{{ $url }}"
            class="px-4 py-2 rounded-lg bg-white border hover:bg-blue-50 hover:text-blue-600 transition">
            {{ $page }}
        </a>
        @endif

        @endforeach
        @endif

        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="px-3 py-2 rounded-lg bg-white border hover:bg-gray-100 transition">
            →
        </a>
        @else
        <span class="px-3 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
            →
        </span>
        @endif

    </div>
</nav>
@endif