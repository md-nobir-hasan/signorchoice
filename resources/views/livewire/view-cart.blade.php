    <!-- shopping cart Us Start -->
    <section class="pb-20">
        <style>
            .size-5 {
                width: 20px;
                height: 20px;
            }
        </style>
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
            <x-broadcam>
                <span>Shopping Cart</span>
            </x-broadcam>
            <x-page-title>
                <span>Shopping Cart</span>
            </x-page-title>
        </div>
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div x-data="{
                    items: [
                        @foreach ($carts as $cart)
                            {
                                id: {{ $cart->id }},
                                quantity: {{ $cart->quantity }},
                                price: {{ $cart->size ? $cart->size->final_price : $cart->product->final_price }},
                                @if($cart->color && $cart->color->price)
                                    colorPrice: {{ $cart->color->price }},
                                @else
                                    colorPrice: 0,
                                @endif
                            },
                        @endforeach
                    ],
                    getTotal(index) {
                        return ((this.items[index].price + this.items[index].colorPrice) * this.items[index].quantity).toFixed(2);
                    },
                    getTotalPrice() {
                        return this.items.reduce((sum, item) => sum + ((item.price + item.colorPrice) * item.quantity), 0).toFixed(2);
                    },
                    confirmDelete(el, cartId) {
                            if (confirm('Are you sure you want to remove this item?')) {
                                fetch(`/cart/delete/${cartId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json',
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log(data);
                                        if (data.status) {
                                            el.closest('tr').remove();
                                            window.location.reload();
                                            toast.success(data.message);
                                        } else {
                                            toast.error(data.message);
                                        }
                                    });
                            }
                        }
                }">
                    <div>
                        <table class="border rounded-md w-full">
                            @foreach ($carts as $cart)
                                <input type="hidden" name="product[{{ $loop->index }}][slug]"
                                    value="{{ $cart->product->slug }}">
                                @php
                                    $photo = explode(',', $cart->product->photo);
                                @endphp
                                <tr class="border-b">
                                    <td class="p-7">
                                        <img class="w-24 h-24" src="{{ $cart->product->thumbnail_url }}" />
                                        <a href="{{ route('product.details', $cart->product->slug) }}" class="block">
                                            {{ $cart->product->title }}
                                        </a>
                                        <span class="text-sm text-secondary">
                                            @if ($cart->color)
                                                {{ $cart->color->color->name }},
                                            @endif
                                            @if ($cart->size)
                                                {{ $cart->size->size->size }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="hidden md:block p-7 ps-0">
                                        <a href="{{ route('product.details', $cart->product->slug) }}" class="block">
                                            {{ $cart->product->title }}
                                        </a>
                                        <span class="text-sm text-secondary">
                                            @if ($cart->color)
                                                {{ $cart->color->color->name }},
                                            @endif
                                            @if ($cart->size)
                                                {{ $cart->size->size->size }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="p-7 ps-0">
                                        <div class="flex">
                                            <div class="border px-1 flex items-center justify-center gap-2">
                                                <button type="button" class="text-secondary hover:text-primary"
                                                    @click="if(items['{{ $loop->index }}'].quantity > 1) items['{{ $loop->index }}'].quantity--"
                                                    onclick="updateQuantity(this, -1)" >
                                                     <!-- Minus icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                    </svg>
                                                </button>
                                                <input type="number" name="product[{{ $loop->index }}][quantity]"
                                                    x-model="items['{{ $loop->index }}'].quantity"
                                                    min="1" class="w-10 text-center"
                                                    onchange="validateQuantity(this)">
                                                <button type="button" class="text-secondary hover:text-primary"
                                                    @click="items['{{ $loop->index }}'].quantity++"
                                                    onclick="updateQuantity(this, 1)">
                                                     <!-- Plus icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-7 ps-0">
                                        <span class="text-xl font-medium" x-text="'BDT ' + getTotal('{{ $loop->index }}')"></span>
                                    </td>
                                    <td class="py-7">
                                        <button type="button" @click="confirmDelete($el, '{{ $cart->id }}')"
                                            class="text-xl font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24">
                                                <path fill="#333"
                                                    d="M7.616 20q-.691 0-1.153-.462T6 18.384V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zm2.192-3h1V8h-1zm3.384 0h1V8h-1z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="flex flex-col md:flex-row items-center justify-between py-12 ps-7 pe-14 border border-t-0">
                            <div></div>
                            <div>
                                <span class="font-medium">Total Price: </span>
                                <span class="text-xl font-medium" x-text="'BDT ' + getTotalPrice()"></span>
                            </div>
                        </div>
                        <div class="mt-7 flex items-center justify-end gap-5">
                            <a href="{{ route('shop') }}">
                                <span class="block px-5 font-semibold py-2 border rounded-full text-sm uppercase">
                                    CONTINUE SHOPPING
                                </span>
                            </a>
                            {{-- <button type="submit"> --}}
                                <button type="submit" class="px-5 font-semibold py-2 rounded-full text-sm uppercase border">
                                    CHECKOUT
                                </button>
                            {{-- </button> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- shopping cart End -->

    @push('scripts')
        <script>

            // Make sure CSRF token is available for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    @endpush
