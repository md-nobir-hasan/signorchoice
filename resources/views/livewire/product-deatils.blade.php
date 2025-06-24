<div>
    <style>
        .size-5 {
            width: 20px;
            height: 20px;
        }
    </style>
    <!-- Product Start -->
    <section>
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl mt-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                @if ($product->photo)
                    @php
                        $photos = explode(',', $product->photo);
                        $photo = $photos[0];
                    @endphp
                @else
                    @php
                        $photo = '/backend/img/thumbnail-default.jpg';
                    @endphp
                @endif

                <div>
                    <div class="mb-5">
                        <!-- Dynamic photo from product -->
                        <img class="w-full" src="{{ $product->thumbnail_url }}" />
                    </div>
                    <!-- Keep existing static image grid -->
                    {{-- <div class="grid grid-cols-3 gap-5">
                        <img class="hover:border-primary border transition-all duration-300" src="{{ $product->thumbnail_url }}"
                        title="{{ $product->title }}">
                        @foreach ($photos as $pto)
                            <img class="hover:border-primary border transition-all duration-300" src="{{ $pto }}"
                                title="{{ $product->title }}">
                        @endforeach
                    </div> --}}
                </div>

                <form action="{{ route('create_cart', $product->slug) }}" method="GET">
                    @csrf
                    <div>
                        <!-- Dynamic title and price -->
                        <h1 class="mb-2 text-2xl font-medium">{{ $product->title }}</h1>
                        <div x-data="{
                            selectedSize: null,
                            sizes: {{ json_encode(
                                $product->sizes->map(function ($size) {
                                    return [
                                        'id' => $size->id,
                                        'size' => $size->size->size,
                                        'price' => $size->price,
                                        'discount' => $size->discount,
                                        'final_price' => $size->final_price,
                                        'is_show' => $size->is_show,
                                    ];
                                }),
                            ) }},
                            init() {
                                this.selectedSize = this.sizes.find(s => s.is_show) || this.sizes[0];
                            }
                        }">
                            <!-- Price Display -->
                            <div class="mb-2">
                                <span class="text-2xl font-medium" x-text="'৳' + selectedSize?.final_price"></span>
                                <template x-if="selectedSize?.discount > 0">
                                    <del class="text-gray-500 ml-2" x-text="'৳' + selectedSize?.price"></del>
                                </template>
                                <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm text-blue-700">For custom or bulk orders, feel free to message our support team on WhatsApp. We'll be happy to assist you!</span>
                                </div>
                            </div>

                            <!-- Size Selector -->
                            <div class="text-sm font-semibold">
                                <span>Size:</span>
                            </div>
                            <div class="mt-3 mb-2 flex items-center">
                                <template x-for="size in sizes" :key="size.id">
                                    <div class="mr-2 mb-4">
                                        <div @click="selectedSize = size"
                                            :class="selectedSize?.id === size.id ? 'bg-primary text-white border' :
                                                'border text-gray-700'"
                                            class="p-2 px-4 text-xs cursor-pointer" x-text="size.size">
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Hidden input for selected size -->
                            <input type="hidden" name="size_id" x-model="selectedSize.id">
                        </div>

                        <!-- Color Selector -->
                        <div x-data="{
                            selectedColor: null,
                            colors: {{ json_encode(
                                $product->colors->map(function ($productColor) {
                                    return [
                                        'id' => $productColor->id,
                                        'name' => $productColor->color->name,
                                        'code' => $productColor->color->code,
                                    ];
                                }),
                            ) }},
                            init() {
                                this.selectedColor = this.colors[0];
                            }
                        }">

                            <div class="text-sm font-semibold">
                                <span>Notes:</span>
                            </div>
                            <div class="mt-4 mb-2 flex items-center flex-wrap">
                                <template x-for="color in colors" :key="color.id">
                                    <div @click="selectedColor = color" :title="color.name"
                                        :class="selectedColor?.id === color.id ? 'border-primary bg-primary text-white' : 'border-gray-200 hover:border-primary'"
                                        class="px-3 py-2  border-2 mr-3 mb-4 cursor-pointer transition-all duration-300 hover:shadow-lg rounded-full">
                                        <!-- Color Name -->
                                        <span x-text="color.name"
                                            class="text-sm font-medium"></span>
                                    </div>
                                </template>
                            </div>
                            <!-- Hidden input for selected color -->
                            <input type="hidden" name="color_id" x-model="selectedColor.id">
                        </div>


                        <!-- Keep existing static buttons -->
                        <div>
                            <div class="mb-6 flex items-center gap-5">
                                {{-- @dd($product->wishlists?->where('user_id', auth()->user()->id)?->count(),$product->wishlists, $product) --}}
                                {{-- wishlist button  --}}
                                @if(auth()->check())
                                    <div
                                        x-data="{
                                            isWishlisted: @json($product->wishlists?->where('product_id', $product->id)?->where('user_id', auth()->user()->id)?->count() > 0 ? true : false),
                                            wishlistCount: @json($product->wishlists?->where('product_id', $product->id)?->count()),
                                            toggleWishlist() {

                                                if (typeof fbq !== 'undefined') {
                                                    fbq('track', 'AddToWishlist', {
                                                        content_ids: [{{ $product->id }}],
                                                        content_name: '{{ $product->title }}',
                                                        content_type: 'product',
                                                        currency: 'BDT',
                                                        contents: [{
                                                            id: {{ $product->id }},
                                                        }]
                                                    });
                                                }

                                                fetch(`/wishlist/{{ $product->slug }}`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if(data.success) {
                                                            this.isWishlisted = !this.isWishlisted;
                                                            this.wishlistCount = data.wishlistCount;

                                                            if(this.isWishlisted) {
                                                                alert('Added to wishlist!');
                                                            } else {
                                                                alert('Removed from wishlist!');
                                                            }
                                                        } else {
                                                            alert(data.message);
                                                        }
                                                    });
                                            }
                                        }"
                                        class="flex items-center gap-2 cursor-pointer relative"
                                        @click="toggleWishlist"
                                    >
                                        <div class="relative">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path
                                                        :fill="isWishlisted ? '#FF4B91' : 'none'"
                                                        :stroke="isWishlisted ? '#FF4B91' : '#333'"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M7.75 3.5C5.127 3.5 3 5.76 3 8.547C3 14.125 12 20.5 12 20.5s9-6.375 9-11.953C21 5.094 18.873 3.5 16.25 3.5c-1.86 0-3.47 1.136-4.25 2.79c-.78-1.654-2.39-2.79-4.25-2.79"
                                                    />
                                                </svg>
                                                <span x-show="wishlistCount > 0" x-text="'('+wishlistCount+')'"></span>
                                            </div>
                                            <!-- Wishlist Count Badge -->
                                            {{-- <div
                                                x-show="wishlistCount > 0"
                                                x-text="wishlistCount"
                                                class="absolute -top-2 -right-2 bg-[#DC275C] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"
                                            ></div> --}}
                                        </div>
                                        <span class="text-secondary text-sm" x-text="isWishlisted ? 'Added to Wishlist' : 'Add to Wishlist'"></span>
                                    </div>
                                @endif
                                {{-- bottle image sliders   --}}
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 32 32">
                                        <path fill="#333"
                                            d="M27 3H5a2.003 2.003 0 0 0-2 2v22a2.003 2.003 0 0 0 2 2h22a2.003 2.003 0 0 0 2-2V5a2.003 2.003 0 0 0-2-2m0 7h-6V5h6Zm-8-2h-6V5h6Zm0 2v8h-6v-8Zm-8 12H5V12h6Zm2-2h6v7h-6Zm8-8h6v4h-6ZM11 5v5H5V5ZM5 24h6v3H5Zm16 3v-9h6v9Z" />
                                    </svg>
                                    <div x-data="{
                                        open: false,
                                        currentSlide: 0,
                                        images: {{ json_encode($product->bottle_image_formatted) }},
                                        nextSlide() {
                                            this.currentSlide = (this.currentSlide + 1) % this.images.length;
                                        },
                                        prevSlide() {
                                            this.currentSlide = (this.currentSlide - 1 + this.images.length) % this.images.length;
                                        }
                                    }">
                                        <!-- Trigger Button -->
                                        <span class="text-secondary text-sm cursor-pointer" @click="open = true">View
                                            Size Chart</span>

                                        <!-- Modal -->
                                        <div style="display: none" x-show="open"
                                            class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50"
                                            @click.away="open = false" x-transition>
                                            <div class="bg-white p-4 rounded-lg shadow-lg max-w-3xl w-full">
                                                <!-- Close Button -->
                                                <div class="relative">
                                                    <button type="button"
                                                        class="absolute top-2 right-2 z-10 bg-black rounded-full text-white text-xs p-1"
                                                        @click="open = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <path fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-width="2"
                                                                d="m8 8l4 4m0 0l4 4m-4-4l4-4m-4 4l-4 4" />
                                                        </svg>
                                                    </button>

                                                    <!-- Content -->
                                                    <template x-if="images.length > 0 && images[0] != ''">
                                                        <!-- Slider Container -->
                                                        <div class="relative">
                                                            <template x-for="(image, index) in images" :key="index">
                                                                <div x-show="currentSlide === index"
                                                                    class="transition-opacity duration-300">
                                                                    <img :src="image" class="w-full h-[500px] object-contain" :alt="`Bottle Image ${index + 1}`">
                                                                </div>
                                                            </template>

                                                            <!-- Navigation Buttons -->
                                                            <button @click="prevSlide" type="button"
                                                                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                                </svg>
                                                            </button>
                                                            <button @click="nextSlide" type="button"
                                                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                                </svg>
                                                            </button>

                                                            <!-- Dots Navigation -->
                                                            <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                                                                <template x-for="(image, index) in images" :key="index">
                                                                    <button type="button" @click="currentSlide = index"
                                                                        :class="{'bg-white': currentSlide === index, 'bg-gray-400': currentSlide !== index}"
                                                                        class="w-2 h-2 rounded-full transition-colors duration-200">
                                                                    </button>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </template>

                                                    <!-- No Images Message -->
                                                    <template x-if="images.length === 0 || images[0] == ''">
                                                        <div class="flex items-center justify-center h-[300px]">
                                                            <p class="text-gray-500 text-lg">No bottle images available</p>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div x-data="{ quantity: 1 }" class="flex items-center gap-5">
                                <div class="p-2 px-4 gap-5 flex items-center rounded-full border">
                                    <span class="text-secondary cursor-pointer"
                                        @click="quantity > 1 ? quantity-- : null">
                                        <!-- Minus icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                          </svg>

                                    </span>
                                    <span x-text="quantity" class="font-semibold"></span>
                                    <input type="hidden" name="quant" value="1" x-model="quantity">
                                    <span class="text-secondary cursor-pointer" @click="quantity++">
                                        <!-- Plus icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                          </svg>

                                    </span>
                                </div>
                                <div>
                                    <span class="cursor-pointer">
                                        <button class="p-2 px-4 text-xs rounded-full bg-primary text-white font-bold"
                                        @click="
                                                if (typeof fbq !== 'undefined') {
                                                    fbq('track', 'AddToCart', {
                                                        content_ids: [{{ $product->id }}],
                                                        content_name: '{{ $product->title }}',
                                                        content_type: 'product',
                                                        value: selectedSize?.final_price || 0,
                                                        currency: 'BDT',
                                                        contents: [{
                                                            id: {{ $product->id }},
                                                            quantity: quantity,
                                                            price: selectedSize?.final_price || 0
                                                        }]
                                                    });
                                                }
                                            ">
                                            ADD TO CART
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Product Description Start -->
    <section>
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  mt-20" x-data="{ activeTab: 'descriptions' }">
            <!-- Button Navigation -->
            <div class="mb-9 flex-wrap flex items-center justify-center gap-5 md:gap-10">
                <button :class="{ 'text-primary border-b-2 border-b-primary': activeTab === 'descriptions' }"
                    @click="activeTab = 'descriptions'" class="font-semibold uppercase">
                    DESCRIPTIONS
                </button>
                <button :class="{ 'text-primary border-b-2 border-b-primary': activeTab === 'information' }"
                    @click="activeTab = 'information'" class="font-semibold uppercase">
                    INFORMATION
                </button>
                <button :class="{ 'text-primary border-b-2 border-b-primary': activeTab === 'reviews' }"
                    @click="activeTab = 'reviews'" class="font-semibold uppercase">
                    REVIEWS
                </button>
            </div>

            <!-- Tab Content -->
            <div>
                <div x-show="activeTab === 'descriptions'">
                    <p class="text-secondary">
                        {!! $product->description !!}
                    </p>
                </div>

                <div x-show="activeTab === 'information'">
                    <p class="text-secondary">
                        {!! $product->summary !!}
                    </p>
                </div>

                <div x-show="activeTab === 'reviews'" class="max-w-4xl mx-auto">
                    <!-- Review Summary -->
                    <div class="flex items-start gap-8 p-6 bg-gray-50 rounded-lg mb-8">
                        <div class="text-center flex-shrink-0">
                            <div class="text-4xl font-bold text-[#380D37] mb-2">
                                {{ number_format($product->productReviews->avg('rate'), 1) }}
                            </div>
                            <div class="flex items-center justify-center gap-1 mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-5 w-5 {{ $i <= round($product->productReviews->avg('rate')) ? 'text-yellow-400' : 'text-gray-300' }}"
                                         viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <div class="text-sm text-gray-500">
                                Based on {{ $product->productReviews->count() }} reviews
                            </div>
                        </div>

                        <div class="flex-grow">
                            @php
                                $ratings = [5, 4, 3, 2, 1];
                                $maxReviews = $product->productReviews->countBy('rate')->max();
                            @endphp

                            @foreach($ratings as $rating)
                                @php
                                    $count = $product->productReviews->where('rate', $rating)->count();
                                    $percentage = $maxReviews > 0 ? ($count / $maxReviews) * 100 : 0;
                                @endphp
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="text-sm text-gray-600 w-12">{{ $rating }} stars</div>
                                    <div class="flex-grow bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-yellow-400 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="text-sm text-gray-600 w-12">{{ $count }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Review List -->
                    <div class="space-y-6">
                        @forelse($product->productReviews->where('status', 'active') as $review)
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-start gap-4 mb-4">
                                    <!-- User Avatar with Initials -->
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full bg-[#380D37]/10 flex items-center justify-center">
                                            @if($review->f_name)
                                                <span class="text-[#380D37] font-semibold text-lg">
                                                    {{ strtoupper(substr($review->f_name, 0, 2)) }}
                                                </span>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#380D37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <div class="font-medium">
                                                        @php
                                                            $name = $review->f_name;
                                                            $maskedName = substr($name, 0, 2) . str_repeat('*', strlen($name) - 2);
                                                        @endphp
                                                        {{ $maskedName }}
                                                    </div>
                                                    <div class="text-gray-500 text-sm">
                                                        {{ $review->created_at->diffForHumans() }}
                                                    </div>
                                                    @if($review->order_id)
                                                        <div class="px-3 py-1 bg-green-50 text-green-700 text-sm rounded-full flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            Verified Purchase
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex items-center mt-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="h-4 w-4 {{ $i <= $review->rate ? 'text-yellow-400' : 'text-gray-300' }}"
                                                             viewBox="0 0 20 20"
                                                             fill="currentColor">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-gray-600 mt-2">
                                            {{ $review->review }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="text-lg font-medium">No reviews yet</p>
                                <p class="mt-1">Be the first to review this product</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Description End -->
    <!-- Products Start -->
    @if ($related_products)
        <section>
            <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  pb-20">
                <div class="pt-14 pb-10 flex flex-col items-center justify-center gap-3">
                    <h2 class="text-xl font-semibold text-center uppercase">
                        You may also like
                    </h2>
                    <span class="w-10 h-1 bg-primary inline-block"></span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    @foreach ($related_products as $rproduct)
                        <a href="{{ route('product.details', $rproduct->slug) }}">
                            <div class="group cursor-pointer">
                                <div class="border group-hover:border-[#ab8e66] transition-all duration-300">
                                    <div class="relative w-full">
                                        @php
                                            $photo = explode(',', $rproduct->photo);
                                        @endphp
                                        <img src="{{ $rproduct->thumbnail_url }}" class=" mx-auto object-contain h-[300px]" />
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
                                        {{ $rproduct->title }}
                                    </h3>
                                    <div>
                                        <div class="flex items-center justify-center w-full mb-2">
                                            {!! $rproduct->echoStar() !!}
                                        </div>
                                        <h4 class="text-sm text-center pb-3">
                                            @if ($rproduct->isDiscount())
                                                <del class="">{{ $rproduct->defaultsize()?->price }}</del>
                                            @endif

                                            <span
                                                class="font-bold text-black">{{ $rproduct->defaultsize()?->final_price }}</span>

                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif
    <!-- Products End -->

</div>

<!-- Add this Alpine.js function to check color brightness -->
<script>
     // Facebook Pixel - Content view event
     if (typeof fbq !== 'undefined') {
            fbq('track', 'ContentView', {
                content_ids: [{{ $product->id }}],
                content_name: "{{ $product->title }}",
                content_type: 'product',
            });
        }

    function isLightColor(color) {
        const hex = color.replace('#', '');
        const r = parseInt(hex.substr(0, 2), 16);
        const g = parseInt(hex.substr(2, 2), 16);
        const b = parseInt(hex.substr(4, 2), 16);
        const brightness = ((r * 299) + (g * 587) + (b * 114)) / 1000;
        return brightness > 155;
    }
</script>


