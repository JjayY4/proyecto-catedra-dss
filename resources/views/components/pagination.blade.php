@if ($paginator->hasPages())
    <div class="flex items-center justify-between mt-8">

        <p class="text-gray-400 text-sm">
            Mostrando
            <span class="text-white font-medium">{{ $paginator->firstItem() }}</span>
            a
            <span class="text-white font-medium">{{ $paginator->lastItem() }}</span>
            de
            <span class="text-white font-medium">{{ $paginator->total() }}</span>
            registros
        </p>

        <div class="flex items-center gap-1">

            {{-- Anterior --}}
            @if($paginator->onFirstPage())
                <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-gray-600 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Páginas --}}
            @foreach($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
                @if($page == $paginator->currentPage())
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-blue-500 bg-blue-600 text-white text-sm font-semibold">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition text-sm">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Siguiente --}}
            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-gray-300 hover:text-white hover:border-blue-500/40 hover:bg-gray-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-gray-600 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif

        </div>
    </div>
@endif