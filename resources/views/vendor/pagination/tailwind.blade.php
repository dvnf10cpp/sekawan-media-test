@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="tw-flex tw-justify-center tw-items-center tw-space-x-2 tw-p-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="tw-py-2 tw-px-4 tw-rounded-md tw-text-gray-400 tw-bg-gray-800 tw-shadow-md tw-opacity-50">
                &laquo; Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="tw-py-2 tw-px-4 tw-rounded-md tw-text-white tw-bg-gray-700 hover:tw-bg-gray-600 tw-shadow-md">
                &laquo; Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="tw-py-2 tw-px-4 tw-text-gray-400 tw-rounded-md">{{ $element }}</span>
            @endif

            {{-- Page Numbers --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="tw-py-2 tw-px-4 tw-rounded-md tw-text-white tw-bg-blue-500 tw-shadow-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="tw-py-2 tw-px-4 tw-rounded-md tw-text-gray-300 tw-bg-gray-800 hover:tw-bg-gray-600 tw-shadow-md">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="tw-py-2 tw-px-4 tw-rounded-md tw-text-white tw-bg-gray-700 hover:tw-bg-gray-600 tw-shadow-md">
                Next &raquo;
            </a>
        @else
            <span class="tw-py-2 tw-px-4 tw-rounded-md tw-text-gray-400 tw-bg-gray-800 tw-shadow-md tw-opacity-50">
                Next &raquo;
            </span>
        @endif
    </nav>
@endif
