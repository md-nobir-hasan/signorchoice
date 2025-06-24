<a class="group cursor-pointer" href="{{ route('product.details', $product->slug) }}" id="product-card{{$product->id}}">
    <div class="border group-hover:border-[#ab8e66] transition-all duration-300">
        <div class="relative w-full">
            @if ($product->product_thumbnail_image)

                <img src="{{ $product->thumbnail_url }}" class=" mx-auto object-contain h-[300px]" alt="{{ $product->title }}">
            @else
                <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class=" mx-auto object-contain h-[300px]"
                    alt="{{ $product->title }}">
            @endif

            @if ($product->stock < 1)
                <span class="text-[14px] text-[#fff] bg-[#ef4a23] absolute top-[-8px] left-[-8px] px-2 py-[2px] rounded-r-lg">
                    Out Of Stock
                </span>
            @endif
            <div class="top-0 left-0 right-0 bottom-0 m-auto absolute h-[300px]">
                <!-- Action buttons -->
                <div class="h-full flex items-center justify-center">
                    <div class="bg-primary flex rounded-full group-hover:mt-0 transition-all duration-300 ease-in-out group-hover:opacity-100 opacity-0 mt-20">
                        <!-- Your existing action buttons -->
                    </div>
                </div>
            </div>
            <!-- New tag -->
            <div class="items-center justify-center absolute top-2 left-2">
                <div class="bg-primary w-10 h-5 flex items-center justify-center text-white font-bold rounded-full">
                    <span class="text-xs">New</span>
                </div>
            </div>
        </div>
        <h3 class="text-primary text-lg font-medium text-center mt-5 mb-2">
            {{ $product->title }}
        </h3>
        <div>
            <div class="flex items-center justify-center w-full mb-2">
                {!! $product->echoStar() !!}
            </div>
            <h4 class="text-sm text-center pb-3">
                @if($product->sizes->where('is_show', true)->first())
                    @php $defaultSize = $product->sizes->where('is_show', true)->first(); @endphp
                    @if($defaultSize->discount > 0)
                        <del class="">BDT {{ number_format($defaultSize->price, 2) }}</del>
                    @endif
                    <span class="font-bold text-black">BDT {{ number_format($defaultSize->final_price, 2) }}</span>
                    <span class="text-xs">({{ $defaultSize->size->size }})</span>
                @endif
            </h4>
        </div>
    </div>
</a>
