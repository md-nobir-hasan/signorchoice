<div>


    <div x-data="{ isGridView: true }">
        <form action="{{ route('shop') }}" id="search_form" method="GET">
            <!-- Top Bar Start -->
            <section class="pb-12">

                <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
                    <x-broadcam>
                        <span>Shop</span>
                    </x-broadcam>
                    <x-page-title>
                        <span>Shop</span>
                    </x-page-title>
                </div>

                <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
                    <div class="  py-4 bg-tertiary mb-10 flex items-center justify-between">
                        <div class="flex flex-col md:flex-row gap-5 md:items-center">
                            <div class="flex flex-col md:flex-row md:items-center gap-2 px-3 font-medium">
                                <span class="text-[13px] text-secondary">Sort</span>
                                <select class="bg-white" name="per_page" id="per_page">
                                    @foreach ([8, 12, 16, 20, 40, 100] as $value)
                                        <option value="{{ $value }}"
                                            {{ request('per_page') == $value ? 'selected' : '' }}>
                                            {{ $value }} Products/Page
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center gap-2 px-3 font-medium">
                                <span class="text-[13px] text-secondary">Sort by</span>
                                <select class="bg-white" name="sort_by" id="sort_by">
                                    @foreach ([
                                                'price_asc' => 'Low to High',
                                                'price_desc' => 'High to Low',
                                                'popularity' => 'Sort By Popularity',
                                                'average_rating' => 'Sort By Average Rating',
                                                'newest' => 'Sort By Newness',
                                            ] as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ request('sort_by') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 56 56"
                                class="cursor-pointer" @click="isGridView = false"
                                :fill="isGridView ? 'currentColor' : '#ab8e66'">
                                <path fill-rule="evenodd"
                                    d="M10 36a3 3 0 1 1 0 6a3 3 0 0 1 0-6m35.998 1c1.106 0 2.002.888 2.002 2c0 1.105-.89 2-2.002 2H18.002A1.996 1.996 0 0 1 16 39c0-1.105.89-2 2.002-2zM10 26a3 3 0 1 1 0 6a3 3 0 0 1 0-6m35.998 1c1.106 0 2.002.888 2.002 2c0 1.105-.89 2-2.002 2H18.002A1.996 1.996 0 0 1 16 29c0-1.105.89-2 2.002-2zM10 16a3 3 0 1 1 0 6a3 3 0 0 1 0-6m35.998 1c1.106 0 2.002.888 2.002 2c0 1.105-.89 2-2.002 2H18.002A1.996 1.996 0 0 1 16 19c0-1.105.89-2 2.002-2z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                class="cursor-pointer" @click="isGridView = true"
                                :fill="isGridView ? '#ab8e66' : 'currentColor'">
                                <path fill-rule="evenodd"
                                    d="M16 16h4v4h-4zm-6 0h4v4h-4zm-6 0h4v4H4zm12-6h4v4h-4zm-6 0h4v4h-4zm-6 0h4v4H4zm12-6h4v4h-4zm-6 0h4v4h-4zM4 4h4v4H4z" />
                            </svg>
                        </div>
                    </div>

                </div>
            </section>
            <!-- Top Bar End -->
            <!-- Products Start Columns -->
            <section :class="isGridView ? ' hidden' : 'block'">
                <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  pb-20">
                    <div class="grid grid-cols-1 gap-5">
                        @foreach ($products as $cproduct)
                            <div class="group cursor-pointer w-full">
                                <div
                                    class="border group-hover:border-[#ab8e66] transition-all duration-300 grid grid-cols-1 md:grid-cols-12">
                                    <div class="  md:col-span-10 grid grid-cols-12 gap-5">
                                        <div class="relative w-full col-span-12 md:col-span-3">
                                           <a href="{{ route('product.details', $cproduct->slug) }}">
                                            <img src="{{ $cproduct->thumbnail_url }}"
                                            class="mx-auto object-contain h-[300px]" />
                                           </a>
                                            <div class="top-0 left-0 right-0 bottom-0 m-auto absolute h-[300px]">
                                                <div class="h-full flex items-center justify-center">
                                                    <div
                                                        class="bg-primary flex rounded-full group-hover:mt-0 transition-all duration-300 ease-in-out group-hover:opacity-100 opacity-0 mt-20">

                                                        {{-- <div class="w-11 h-11 flex items-center justify-end">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="none" stroke="#fff"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M7.75 3.5C5.127 3.5 3 5.76 3 8.547C3 14.125 12 20.5 12 20.5s9-6.375 9-11.953C21 5.094 18.873 3.5 16.25 3.5c-1.86 0-3.47 1.136-4.25 2.79c-.78-1.654-2.39-2.79-4.25-2.79" />
                                                            </svg>
                                                        </div>
                                                        <div class="w-11 h-11 flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="none" stroke="#fff"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="m21 21l-4.343-4.343m0 0A8 8 0 1 0 5.343 5.343a8 8 0 0 0 11.314 11.314" />
                                                            </svg>
                                                        </div> --}}
                                                        <div class="w-11 h-11 flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 56 56">
                                                                <path fill="#fff"
                                                                    d="M14.559 51.953h27.586c4.218 0 6.656-2.437 6.656-7.266V20.43c0-4.828-2.461-7.266-7.36-7.266h-3.726c-.14-4.922-4.406-9.117-9.703-9.117c-5.32 0-9.586 4.195-9.727 9.117H14.56c-4.875 0-7.36 2.414-7.36 7.266v24.258c0 4.851 2.485 7.265 7.36 7.265M28.012 7.61c3.304 0 5.812 2.485 5.93 5.555h-11.86c.094-3.07 2.602-5.555 5.93-5.555M14.629 48.18c-2.344 0-3.656-1.242-3.656-3.679V20.617c0-2.437 1.312-3.68 3.656-3.68h26.766c2.296 0 3.632 1.243 3.632 3.68V44.5c0 2.438-1.336 3.68-2.953 3.68Z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="items-center justify-center absolute top-2 left-2">
                                                <div
                                                    class="bg-primary w-10 h-5 flex items-center justify-center text-white font-bold rounded-full">
                                                    <span class="text-xs">New</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-span-12 md:col-span-9 flex flex-col items-center md:items-start justify-center md:justify-start">
                                            <h3 class="text-primary text-lg font-medium text-center mt-5">
                                               <a href="{{ route('product.details', $cproduct->slug) }}">{{ $cproduct->title }}</a>
                                            </h3>
                                            <div>
                                                <div
                                                    class="mt-1 flex items-center md:items-start justify-center md:justify-start w-full mb-5">
                                                    {!! $cproduct->echoStar() !!}
                                                </div>
                                                <h3 class="text-sm">
                                                    Material:
                                                    <span class="text-secondary">Plastic Woody</span>
                                                </h3>
                                                <h3 class="text-sm">
                                                    Color:
                                                    <span class="text-secondary">
                                                        @foreach ($cproduct->colors as $color)
                                                            <span>{{ $color?->color?->name }} </span>
                                                        @endforeach
                                                    </span>
                                                </h3>
                                                <h3 class="text-sm">
                                                    Pots Size:
                                                    <span class="text-secondary">
                                                        @foreach ($cproduct->sizes as $size)
                                                            <span>{{ $size?->size?->size }} </span>
                                                        @endforeach
                                                    </span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" md:col-span-2 border-l p-7 flex flex-col items-center gap-3">
                                        <h3 class="font-bold text-black text-2xl">
                                            @if ($cproduct->sizes->where('is_show', true)->first())
                                                @php $defaultSize = $cproduct->sizes->where('is_show', true)->first(); @endphp
                                                BDT {{ number_format($defaultSize->final_price, 2) }}
                                                <span class="text-sm">({{ $defaultSize?->size?->size }})</span>
                                            @endif
                                        </h3>
                                        <h4 class="flex items-center gap-1 text-sm">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-width="1.5">
                                                    <path stroke-linejoin="round" stroke-miterlimit="1.5"
                                                        d="M8 19a2 2 0 1 0 0-4a2 2 0 0 0 0 4m10 0a2 2 0 1 0 0-4a2 2 0 0 0 0 4" />
                                                    <path
                                                        d="M10.05 17H15V6.6a.6.6 0 0 0-.6-.6H1m4.65 11H3.6a.6.6 0 0 1-.6-.6v-4.9" />
                                                    <path stroke-linejoin="round" d="M2 9h4" />
                                                    <path
                                                        d="M15 9h5.61a.6.6 0 0 1 .548.356l1.79 4.028a.6.6 0 0 1 .052.243V16.4a.6.6 0 0 1-.6.6h-1.9M15 17h1" />
                                                </g>
                                            </svg> --}}
                                            {{-- <span>Free Delivery</span> --}}
                                        </h4>
                                        <a href="{{ route('create_cart', $cproduct->slug) }}/?color_id={{ $cproduct->colors->first()->id }}&size_id={{ $cproduct->sizes->first()->id }}&quant=1">
                                            <button type="button"
                                                class="p-2 px-4 text-xs rounded-full bg-primary text-white font-bold">
                                                ADD TO CART
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
            <!-- Products Start Columns End -->

            <!-- Products Start Grid -->
            <section :class="isGridView ? ' block' : 'hidden'">
                <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  pb-20">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        @foreach ($products as $gproduct)
                            <a href="{{ route('product.details', $gproduct->slug) }}">
                                <div class="group cursor-pointer">
                                    <div class="border group-hover:border-[#ab8e66] transition-all duration-300">
                                        <div class="relative w-full">
                                            <img src="{{ $gproduct->thumbnail_url }}"
                                                class="mx-auto object-contain h-[300px]" />
                                            <div class="top-0 left-0 right-0 bottom-0 m-auto absolute h-full">
                                                <div class="h-[300px] flex items-center justify-center">
                                                    <div
                                                        class="bg-primary flex rounded-full group-hover:mt-0 transition-all duration-300 ease-in-out group-hover:opacity-100 opacity-0 mt-20">
                                                        {{-- <div class="w-11 h-11 flex items-center justify-end">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="none" stroke="#fff"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M7.75 3.5C5.127 3.5 3 5.76 3 8.547C3 14.125 12 20.5 12 20.5s9-6.375 9-11.953C21 5.094 18.873 3.5 16.25 3.5c-1.86 0-3.47 1.136-4.25 2.79c-.78-1.654-2.39-2.79-4.25-2.79" />
                                                            </svg>
                                                        </div>
                                                        <div class="w-11 h-11 flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24">
                                                                <path fill="none" stroke="#fff"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="m21 21l-4.343-4.343m0 0A8 8 0 1 0 5.343 5.343a8 8 0 0 0 11.314 11.314" />
                                                            </svg>
                                                        </div> --}}
                                                        <div class="w-11 h-11 flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 56 56">
                                                                <path fill="#fff"
                                                                    d="M14.559 51.953h27.586c4.218 0 6.656-2.437 6.656-7.266V20.43c0-4.828-2.461-7.266-7.36-7.266h-3.726c-.14-4.922-4.406-9.117-9.703-9.117c-5.32 0-9.586 4.195-9.727 9.117H14.56c-4.875 0-7.36 2.414-7.36 7.266v24.258c0 4.851 2.485 7.265 7.36 7.265M28.012 7.61c3.304 0 5.812 2.485 5.93 5.555h-11.86c.094-3.07 2.602-5.555 5.93-5.555M14.629 48.18c-2.344 0-3.656-1.242-3.656-3.679V20.617c0-2.437 1.312-3.68 3.656-3.68h26.766c2.296 0 3.632 1.243 3.632 3.68V44.5c0 2.438-1.336 3.68-2.953 3.68Z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="items-center justify-center absolute top-2 left-2">
                                                <div
                                                    class="bg-primary w-10 h-5 flex items-center justify-center text-white font-bold rounded-full">
                                                    <span class="text-xs">New</span>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="text-primary text-lg font-medium text-center mt-5 mb-2">
                                            {{ $gproduct->title }}
                                        </h3>
                                        <div>
                                            <div class="flex items-center justify-center w-full mb-2">
                                                {!! $gproduct->echoStar() !!}
                                            </div>
                                            <h4 class="text-sm text-center pb-3">
                                                @if ($size = $gproduct->defaultsize())
                                                    @if ($gproduct->isDiscount())
                                                        <del class="">BDT
                                                            {{ number_format($size->price, 2) }}</del>
                                                    @endif
                                                    <span class="font-bold text-black">BDT
                                                        {{ number_format($size->final_price, 2) }}</span>
                                                    <span class="text-xs">({{ $size->size->size }})</span>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>

                    {{-- Pagination --}}
                    <div class="flex items-center justify-center gap-2 mt-10">
                        {{-- Previous Page --}}
                        @if (!$products->onFirstPage())
                            <div onclick="submitPage({{ $products->currentPage() - 1 }})"
                                class="w-10 h-10 rounded-full border flex items-center justify-center font-medium cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m14 7l-5 5l5 5" />
                                </svg>
                            </div>
                        @else
                            <div class="w-10 h-10 rounded-full border flex items-center justify-center font-medium opacity-50 cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m14 7l-5 5l5 5" />
                                </svg>
                            </div>
                        @endif

                        {{-- Page Numbers --}}
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <div onclick="submitPage({{ $i }})"
                                class="w-10 h-10 rounded-full border flex items-center justify-center font-medium cursor-pointer {{ $products->currentPage() == $i ? 'bg-primary text-white' : '' }}">
                                <span>{{ $i }}</span>
                            </div>
                        @endfor

                        {{-- Next Page --}}
                        @if ($products->hasMorePages())
                            <div onclick="submitPage({{ $products->currentPage() + 1 }})"
                                class="w-10 h-10 rounded-full border flex items-center justify-center font-medium cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" />
                                </svg>
                            </div>
                        @else
                            <div class="w-10 h-10 rounded-full border flex items-center justify-center font-medium opacity-50 cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="m13.292 12l-4.6-4.6l.708-.708L14.708 12L9.4 17.308l-.708-.708z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Add hidden input for page number --}}
                    <input type="hidden" name="page" id="page_number" value="{{ $products->currentPage() }}">
                </div>
            </section>
            <!-- Products End -->
        </form>
    </div>
    <script>
        document.getElementById('per_page').addEventListener('change', function() {
            document.getElementById('search_form').submit();
        });

        document.getElementById('sort_by').addEventListener('change', function() {
            document.getElementById('search_form').submit();
        });

        function submitPage(page) {
            document.getElementById('page_number').value = page;
            document.getElementById('search_form').submit();
        }
    </script>
</div>
