<div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    {{-- Alert message  --}}
    @if ($error = session('error'))
        <script>
            toastr.success("{{ $error }}")
        </script>
    @endif
    @if ($success = session('success'))
        <script>
            toastr.success("{{ $success }}")
        </script>
    @endif
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        #bestseller {
            scroll-margin-top: 130px;
        }

        .swiper-pagination-bullet-active {
            background: none !important;
            border: 1px solid #ab8e66 !important;
            width: 16px !important;
            height: 16px !important;
        }

        .deals-of-the-day-swiper-pagination {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .hero-swiper-pagination {
            display: flex !important;
            align-items: center;
            justify-content: center;
            margin-top: -20px;
            z-index: 20;
            position: relative !important;
        }

        .news-swiper-pagination {
            display: flex !important;
            align-items: center;
            justify-content: center;
        }
    </style>


    <!-- Hero Section Start -->
    <section class="mt-5 mb-10">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="col-span-1 md:col-span-2 row-span-2 border w-full overflow-hidden">
                    <div class="swiper hero-swiper">
                        <div class="swiper-wrapper">

                            @foreach ($banner_products as $hero_product)
                                @php
                                    $product_size = $hero_product->defaultsize();
                                    $max_discount = $hero_product->sizes->max('discount');
                                    $max_discount_percentage = round(($max_discount / $product_size->price) * 100);
                                @endphp

                                <div style="width: 100%; height: 100%"
                                    class="swiper-slide bg-no-repeat object-cover bg- w-full p-5 md:pl-12 md:pt-44 md:pb-48 md:pr-12 flex flex-col gap-16 relative">
                                    <img src="{{ $hero_product->banner_url }}"
                                        class="absolute top-0 left-0 bottom-0 -z-10 right-0 w-full h-full" />
                                    <div class="max-sm:max-w-[200px]">

                                        <h3
                                            class="max-sm:text-xl font-semibold animate__fadeInDownBig animate__animated uppercase mb-3 text-primary relative transition-all duration-500">
                                            Sale Up To {{ $max_discount_percentage }}%
                                        </h3>
                                        <h1 class="mb-2 max-sm:text-2xl text-4xl font-medium animate__fadeInLeftBig animate__animated">
                                            {{ $hero_product->title }}
                                        </h1>
                                        <p class="text-lg font-medium animate__fadeInRightBig animate__animated">
                                            New Price:
                                            <span class="text-3xl font-semibold text-primary max-sm:block max-sm:text-xl">BDT
                                                {{ number_format($product_size?->final_price, 2) }}</span>
                                        </p>
                                    </div>
                                    <div>
                                        <a href="{{ route('product.details', $hero_product->slug) }}"
                                            class="shop-btn animate__fadeInUpBig  animate__animated">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="hero-swiper-pagination"></div>
                    </div>
                </div>


                    @foreach ($offer_banner as $banner)
                        @if($loop->first)
                            <a href="{{ route('shop') }}">
                                <div style="width: 100%; height: 298px" class="bg-no-repeat py-14 pl-7 pr-40 relative">
                                    <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full -z-10"
                                        src="{{ $banner->photo }}" />
                                    <h3 x-bind:class="active ? 'top-0 opacity-100' : 'top-12 opacity-0'"
                                        class="font-medium mb-3 text-2xl relative transition-all duration-500">
                                        {{ $banner->title }}
                                    </h3>
                                    <p class="text-secondary mb-4">
                                        {{ $banner->description }}
                                    </p>

                                    <button class="shop-btn">
                                        Shop Now
                                    </button>
                                </div>
                            </a>
                        @endif
                        @if($loop->last)
                            <a href="#bestseller">
                                <div style="width: 100%; height: 298px" class="bg-no-repeat py-14 pl-7 pr-40 relative">
                                    <img class="absolute top-0 bottom-0 left-0 right-0 w-full h-full -z-10"
                                        src="{{ $banner->photo }}" />
                                    <h3 class="text-2xl mb-2 font-bold">
                                        {{ $banner->title }}
                                    </h3>
                                    <p class="text-secondary mb-4">
                                        {{ $banner->description }}
                                    </p>
                                </div>
                            </a>
                        @endif
                    @endforeach


            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Deal of The Day Start -->
    <section>
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
            <h3 class="pb-3 text-center text-3xl font-semibold">DEAL OF THE DAY</h3>
            <div class="text-center mb-14">
                <span class="w-16 bg-primary inline-block h-1"></span>
            </div>
            <div class="swiper deals-of-the-day-swiper pb-20">
                <div class="swiper-wrapper pb-5">
                    @foreach ($deal_of_the_day as $na)
                        <a class="swiper-slide" href="{{ route('product.details', $na->slug) }}">
                            <div class="group cursor-pointer">
                                <div class="border group-hover:border-[#ab8e66] transition-all duration-300">
                                    <div class="relative w-full">
                                        <img src="{{ asset($na->thumbnail_url) }}" title="{{ $na->title }}"
                                            class=" object-contain mx-auto h-[300px]" />
                                        <div class="top-0 left-0 right-0 bottom-0 m-auto absolute h-full">
                                            <div class="h-[300px] flex items-center justify-center">
                                                <div
                                                    class="bg-primary flex rounded-full group-hover:mt-0 transition-all duration-300 ease-in-out group-hover:opacity-100 opacity-0 mt-20">
                                                    {{-- <div class="w-11 h-11 flex items-center justify-end">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <path fill="none" stroke="#fff" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1.5"
                                                                d="M7.75 3.5C5.127 3.5 3 5.76 3 8.547C3 14.125 12 20.5 12 20.5s9-6.375 9-11.953C21 5.094 18.873 3.5 16.25 3.5c-1.86 0-3.47 1.136-4.25 2.79c-.78-1.654-2.39-2.79-4.25-2.79" />
                                                        </svg>
                                                    </div>
                                                    <div class="w-11 h-11 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <path fill="none" stroke="#fff" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="1.5"
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
                                    {{-- <div class="flex items-center justify-center gap-3 mb-3 m-3">
                                        <div
                                            class="bg-tertiary w-full h-full rounded-full text-xs flex flex-col items-center justify-center gap-1 py-3">
                                            <h4 class="font-bold">00</h4>
                                            <span>DAYS</span>
                                        </div>
                                        <div
                                            class="bg-tertiary w-full h-full rounded-full text-xs flex flex-col items-center justify-center gap-1 py-3">
                                            <h4 class="font-bold">00</h4>
                                            <span>HRS</span>
                                        </div>
                                        <div
                                            class="bg-tertiary w-full h-full rounded-full text-xs flex flex-col items-center justify-center gap-1 py-3">
                                            <h4 class="font-bold">00</h4>
                                            <span>MINS</span>
                                        </div>
                                        <div
                                            class="bg-tertiary w-full h-full rounded-full text-xs flex flex-col items-center justify-center gap-1 py-3">
                                            <h4 class="font-bold">00</h4>
                                            <span>SECS</span>
                                        </div>
                                    </div> --}}
                                    <h3 class="text-primary text-lg font-medium text-center mb-2">
                                        {{ $na->title }}
                                    </h3>
                                    <div>
                                        <div class="flex items-center justify-center w-full mb-2">
                                            {!! $na->echoStar() !!}
                                        </div>
                                        <h4 class="text-sm text-center pb-3">
                                            @if ($na->sizes->where('is_show', true)->first())
                                                @php $defaultSize = $na->sizes->where('is_show', true)->first(); @endphp
                                                @if ($defaultSize->discount > 0)
                                                    <del class="">BDT
                                                        {{ number_format($defaultSize->price, 2) }}</del>
                                                @endif
                                                <span class="font-bold text-black">BDT
                                                    {{ number_format($defaultSize->final_price, 2) }}</span>
                                                <span class="text-xs">({{ $defaultSize->size->size }})</span>
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="deals-of-the-day-swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- Deal of The Day End -->

    <!-- Best Collection Start -->
    <section class="my-10">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl grid-cols-1 grid md:grid-cols-2 gap-5">
            @foreach ($best_collection as $best_product)
                <a href="{{ route('product.details', $best_product->slug) }}">
                    <div style="width: 100%"
                        class="bg-no-repeat p-5 md:h-[300px] md:py-14 md:pl-10 bg-cover md:pr-[300px] relative">
                        <img class="absolute top-0 bottom-0 left-0 right-0 -z-10 w-full h-full"
                            src="{{ $best_product->best_collection_url }}" />
                        <h3 class="text-sm font-semibold mb-1 text-primary">
                            TOP STAFF PICK
                        </h3>
                        <h2 class="mb-3 text-2xl font-medium">Best Collection</h2>
                        <p class="text-secondary mb-7">
                            {{ $best_product->title }}
                        </p>
                        <button class="shop-btn">
                            Shop Now
                        </button>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    <!-- Best Collection End -->

    <!-- Collection Arrival Start  -->
    @if($collection_arrived)
    <section class="mt-5 mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div style="width: 100%"
            class="  flex flex-col items-center justify-center py-12 bg-no-repeat bg-cover relative">
            <img class="absolute top-0 right-0 bottom-0 left-0 w-full h-full -z-10" src="{{ $collection_arrived?->collection_arrived_url }}" />
            <h2 class="font-medium text-4xl mb-2">Collection Arrived</h2>
            <p class="mb-4 text-hard text-center">
                {{ $collection_arrived?->title }}
            </p>
            <p class="mb-5 text-hard">
                Price from:
                <span class="text-primary text-3xl font-semibold">BDT
                    {{ number_format($collection_arrived?->sizes->min('final_price'), 2) }}</span>
            </p>

            <a href="{{ route('product.details', $collection_arrived?->slug) }}"
                class="shop-btn">
                Shop Now
            </a>
            </div>
        </section>
    @endif
    <!-- Collection Arrival End  -->

    <!-- Products Start -->
    <section class="my-20" x-data="{ selectedCategory: 'bestseller' }">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <!-- Category Buttons -->
            <div class="flex flex-wrap gap-5 items-center justify-center mb-14">
                <div class="mx-5">
                    <button class="font-medium text-lg rounded-full py-2 px-6 transtion-all duration-300"
                        :class="selectedCategory === 'bestseller' ? 'bg-primary text-white hover:bg-black' :
                            'hover:bg-primary bg-black text-white'"
                        @click="selectedCategory = 'bestseller'">
                        Bestseller
                    </button>
                </div>
                <div class="mx-5">
                    <button class="font-medium text-lg rounded-full py-2 px-6 transtion-all duration-300"
                        :class="selectedCategory === 'new_arrivals' ? 'bg-primary text-white hover:bg-black' :
                            'hover:bg-primary bg-black text-white'"
                        @click="selectedCategory = 'new_arrivals'">
                        New Arrivals
                    </button>
                </div>
                <div class="mx-5">
                    <button class="font-medium text-lg rounded-full py-2 px-6 transtion-all duration-300"
                        :class="selectedCategory === 'top_rated' ? 'bg-primary text-white hover:bg-black' :
                            'hover:bg-primary bg-black text-white'"
                        @click="selectedCategory = 'top_rated'">
                        Top Rated
                    </button>
                </div>
            </div>

            <!-- Product Grid -->
            <div id="bestseller">

                <template x-if="selectedCategory === 'new_arrivals'">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        @foreach ($new_arrivals as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </template>

                <template x-if="selectedCategory === 'bestseller'">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        @foreach ($bestsellers as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </template>

                <template x-if="selectedCategory === 'top_rated'">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        @foreach ($top_rated as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </template>
            </div>
        </div>
    </section>
    <!-- Products End -->


    <!-- Services Start -->
    <section class="bg-primary py-12">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  grid grid-cols-1 md:grid-cols-3">
            <div class="flex flex-col md:flex-row justify-center md:justify-start items-center gap-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24">
                    <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2">
                        <path
                            d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09M12 15l-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.4 22.4 0 0 1-4 2" />
                        <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0m1 7v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                    </g>
                </svg>
                <div class="flex flex-col items-center justify-center md:items-start md:justify-start">
                    <h3 class="mb-2 text-white font-semibold uppercase">
                        EU FREE DELIVERY
                    </h3>
                    <p class="text-white">
                        Free Delivery on all order from EU with price more than $90.00
                    </p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-center md:justify-start items-center gap-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24">
                    <path fill="#fff"
                        d="M11.896 18a.75.75 0 0 1-.75.75c-3.792 0-6.896-3.005-6.896-6.75s3.104-6.75 6.896-6.75c3.105 0 5.749 2.015 6.605 4.801l.603-1.02a.75.75 0 0 1 1.292.763l-1.63 2.755a.75.75 0 0 1-1.014.272L14.18 11.23a.75.75 0 1 1 .737-1.307l1.472.83c-.574-2.288-2.691-4.003-5.242-4.003C8.149 6.75 5.75 9.117 5.75 12s2.399 5.25 5.396 5.25a.75.75 0 0 1 .75.75" />
                </svg>
                <div class="flex flex-col items-center justify-center md:items-start md:justify-start">
                    <h3 class="mb-2 text-white font-semibold uppercase">
                        Money Back Gurantee
                    </h3>
                    <p class="text-white">
                        Free Delivery on all order from EU with price more than $90.00
                    </p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-center md:justify-start items-center gap-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24">
                    <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2">
                        <path d="M5 13a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2z" />
                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0-2 0m-3-5V7a4 4 0 1 1 8 0v4" />
                    </g>
                </svg>
                <div class="flex flex-col items-center justify-center md:items-start md:justify-start">
                    <h3 class="mb-2 text-white font-semibold uppercase">
                        Online Support 24/7
                    </h3>
                    <p class="text-white">
                        Free Delivery on all order from EU with price more than $90.00
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Services End -->

    <!-- Latest News Start -->
    @if ($latest_news->count() > 0)
        <section class="my-20">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
                <h3 class="pb-3 text-center text-3xl font-semibold">Our Latest News</h3>
                <div class="text-center mb-14">
                    <span class="w-16 bg-primary inline-block h-1"></span>
                </div>
                <div class="swiper news-swiper pb-20">
                    <div class="swiper-wrapper pb-5">
                        @foreach ($latest_news as $news)
                            <div class="swiper-slide">
                                <div class="relative group">
                                    <img src="{{ photoFirst($news->photo) }}" class="object-cover h-96" />
                                    <div
                                        class="bg-black top-0 right-0 left-0 absolute w-full h-96 group-hover:opacity-75 opacity-0 transition-all duration-150">
                                    </div>
                                </div>
                                <p class="text-hard mt-2 mb-1 text-xs font-medium">
                                    {{ $news->created_at->format('F d, Y') }}
                                </p>
                                <h3 class="mb-4 text-xl font-medium text-black">
                                    {{ $news->title }}
                                </h3>
                                <p class="text-hard mb-2">
                                    {!! Str::words($news->summary, 30) !!}
                                </p>
                                <a href="{{ route('blogs', $news->slug) }}" class="shop-btn">
                                    Read More
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <div class="news-swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif
    <!-- Latest News End -->
    <hr />

    <!-- Instagram Feed Start -->
    <section>
        <div class="text-center my-10">
            <div class="flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24">
                    <g fill="none" stroke="#ab8e66" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16a4 4 0 1 0 0-8a4 4 0 0 0 0 8" />
                        <path d="M3 16V8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m17.5 6.51l.01-.011" />
                    </g>
                </svg>
            </div>
            <h3 class="pb-3 text-center text-3xl font-semibold">INSTAGRAM FEED</h3>
            <div class="text-center mb-14">
                <span class="w-16 bg-primary inline-block h-1"></span>
            </div>
        </div>
        <div class="md:flex-nowrap md:flex-row flex flex-col swiper instagram-swiper">
            <div class="swiper-wrapper">
                @foreach ($instagram_products as $instagram_product)
                    <a href="{{$instagram_product->instagram_link}}" class="swiper-slide" target="_blank">
                        <div class="group relative cursor-pointer w-full">
                            <img src="{{$instagram_product->instagram_url}}"
                                class="w-full h-72 object-cover" />

                            <div
                                class="group-hover:h-72 group-hover:w-full h-0 w-0 absolute m-auto top-0 left-0 right-0 bottom-0 cursor-pointer transition-all duration-300 ease-out bg-black group opacity-0 group-hover:opacity-30">
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                class="absolute group-hover:opacity-100 opacity-0 transition-all duration-300 top-0 right-0 bottom-0 left-0 m-auto">
                                <g fill="none" stroke="#fff" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16a4 4 0 1 0 0-8a4 4 0 0 0 0 8" />
                                    <path d="M3 16V8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m17.5 6.51l.01-.011" />
                                </g>
                            </svg>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Instagram Feed End -->

</div>

<script>
    function productFilter() {
        return {
            selectedCategory: 'new_arrivals',
            products: {

                new_arrivals: @json($new_arrivals),

            },
            get filteredProducts() {
                return this.products[this.selectedCategory];
            },
            selectCategory(category) {
                this.selectedCategory = category;
            },
        };
    }
</script>
