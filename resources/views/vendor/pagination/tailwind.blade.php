@if ($paginator->hasPages())
<div role="Page navigation" aria-label="Page navigation example" class="flex items-center justify-between font-sarabun">
    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
        <span
            class="relative inline-flex items-center px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
            {!! __('pagination.previous') !!}
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
            class="relative inline-flex items-center px-4 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            {!! __('pagination.previous') !!}
        </a>
        @endif

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="relative inline-flex items-center px-4 py-2 ml-3 text-base font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover text-gray-700 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            {!! __('pagination.next') !!}
        </a>
        @else
        <span
            class="relative inline-flex items-center px-4 py-2 ml-3 text-base font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
            {!! __('pagination.next') !!}
        </span>
        @endif
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-base text-gray-700 leading-5">
                {!! __('รายการ') !!}
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('ถึง') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                {!! __('จาก') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('รายการ') !!}
            </p>
        </div>
        <ul class="inline-flex items-center -space-x-px">
            <!-- Previous Page Link ก่อนหน้า -->
            @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                <span
                    class="relative inline-flex items-center px-2 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                    aria-hidden="true">
                    <svg class="w-5 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="relative inline-flex items-center px-2 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-blue-600 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active text-gray-700 transition ease-in-out duration-150"
                aria-label="{{ __('pagination.previous') }}">
                <svg class="w-5 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
            <li>
                <a href="#"
                    class="py-2 px-3 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-blue-600 ">{{
                    $element }}</a>
            </li>
            @endif
            <!-- Array Of Links -->
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li>
                <a href="{{ $url }}" aria-current="page" aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                    class="z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100
                     hover:text-blue-700 ">{{ $page }}</a>
            </li>
            @else
            <li>
                <a href="{{ $url }}"
                    class="py-2 px-3 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-blue-600 "
                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                    {{ $page }}
                </a>
            </li>
            @endif
            @endforeach
            @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-base font-medium text-gray-700
            bg-white border border-gray-300 rounded-r-md leading-5 hover:text-blue-600 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300
            active:bg-gray-100 active text-gray-700 transition ease-in-out duration-150"
                aria-label="{{ __('pagination.next') }}">
                <svg class="w-5 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            @else
            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                <span
                    class="relative inline-flex items-center px-2 py-2 -ml-px text-base font-medium text-gray-700 bg-white border border-gray-300 cursor-default rounded-r-md leading-5"
                    aria-hidden="true">
                    <svg class="w-5 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </span>
            @endif
        </ul>
    </div>
    @endif
