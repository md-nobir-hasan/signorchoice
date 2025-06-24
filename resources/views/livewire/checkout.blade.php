<div>
    @php
        $user = auth()->user();
    @endphp
    <!-- CHECKOUT Start -->
    <section class="pb-20">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
            <x-broadcam>
                <span>Checkout</span>
            </x-broadcam>
            <x-page-title>
                <span>Checkout</span>
            </x-page-title>
        </div>
        <form action="{{ route('checkout.order') }}" method="POST">
                @csrf
                <div x-data="{
                    step: 'shipping',
                    shipping: { firstName: '', lastName: '', country: '', state: '', city: '', zipCode: '', address: '' },
                    payment: { method: 'mobile_banking', cardNumber: '', month: '', year: '', cvv: '' },
                    orderConfirmed: false,
                }">
                    <!-- Shipping Start -->
                    <div x-show="step === 'shipping'" class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
                        <div class="border rounded px-5 md:ps-7 py-10 mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-20">
                                <div class="md:col-span-2">
                                    <h3 class="pb-1 text-lg font-medium">Shipping Address</h3>
                                    <div class="mb-6">
                                        <span class="inline-block h-[2px] w-5 bg-primary"></span>
                                    </div>
                                    @if (session('errors'))
                                        @foreach (session('errors')->all() as $error)
                                            <div class="text-red-500 mb-1">
                                                {{ $error }}
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                                        <div>
                                            <label class="text-sm mb-1">Address <span class="text-red-500">*</span></label>
                                            <input name="address" type="text" value="{{ old('address') ?: $address }}" class="py-2 px-5 rounded-full w-full border" />
                                        </div>
                                        <div>
                                            <label class="text-sm mb-1">Phone <span class="text-red-500">*</span></label>
                                            <input name="phone" type="text" value="{{ old('phone') ?: $phone }}" class="py-2 px-5 rounded-full w-full border" />
                                        </div>
                                        <div>
                                            <label class="text-sm mb-1">City <span class="text-red-500">*</span></label>
                                            <input name="city" type="text" value="{{ old('city') ?: $city }}" class="py-2 px-5 rounded-full w-full border" />
                                        </div>
                                        <div>
                                            <label class="text-sm mb-1">Zip Code </label>
                                            <input name="post_code" type="number" value="{{ old('post_code') ?: $post_code }}" class="py-2 px-5 rounded-full w-full border" />
                                        </div>
                                    </div>

                                    @if($shipping->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                                        <div>
                                            <label class="text-sm mb-1 font-bold">Delivery Charge:</label>
                                            <div class="flex items-center">
                                                @foreach ($shipping as $ship)
                                                    <input type="radio"
                                                        id="shipping_{{ $ship->id }}"
                                                        name="shipping_id"
                                                        value="{{ $ship->id }}"
                                                        @checked(old('shipping_id') == $ship->id)
                                                        data-price="{{ $ship->price }}"
                                                        class="mr-2 shipping-radio"
                                                        {{ $loop->first ? 'checked' : '' }} />
                                                    <label for="shipping_{{ $ship->id }}" class="mr-4">{{ $ship->type }} (BDT {{ $ship->price }})</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <h3 class="pb-1 text-lg font-medium">Your Order</h3>
                                    <div class="mb-6">
                                        <span class="inline-block h-[2px] w-5 bg-primary"></span>
                                    </div>
                                    <div>
                                        @php
                                            $total_amount = 0;
                                        @endphp
                                        @foreach ($carts as $cart)
                                            @php
                                                $price = $cart->size ? $cart->size->final_price : $cart->product->final_price;
                                                $total_amount += $price * $cart->quantity;
                                            @endphp
                                            <div class="flex items-center gap-7 pb-7 border-b mb-7">
                                                <img class="w-24 h-24" src="{{ $cart->product->thumbnail_url }}" />
                                                <div>
                                                    <h4 class="py-1 font-medium">{{ $cart->product->title }}</h4>
                                                    <h4 class="font-semibold">BDT {{ $price }} x{{ $cart->quantity }}</h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <h3 class="font-medium">Total Price: <span class="text-xl font-medium">BDT <span id="totalPrice">{{ $total_amount }}</span></span></h3>
                                </div>
                            </div>
                            <div class="flex items-end justify-end mb-12">
                                <button type="button" class="flex items-center gap-2 py-2 px-5 border rounded-full text-xs font-semibold uppercase" @click="step = 'payment'">
                                    <span>PAYMENT</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M13.293 7.293a1 1 0 0 0 0 1.414L15.586 11H8a1 1 0 0 0 0 2h7.586l-2.293 2.293a.999.999 0 1 0 1.414 1.414L19.414 12l-4.707-4.707a1 1 0 0 0-1.414 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Shipping End -->

                    <!-- Payment Start -->
                    <div x-show="step === 'payment'" x-transition class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl" x-init="payment.method = '{{ old('payment_type') == 'bank_transfer' ? 'bank_transfer' : 'mobile_banking' }}'">
                        <div class="border rounded px-5 md:ps-7 py-10 mb-6">
                            <h3 class="pb-1 text-lg font-medium">Payment Method</h3>
                            <div class="mb-6">
                                <span class="inline-block h-[2px] w-5 bg-primary"></span>
                            </div>
                            <div class="space-y-6">
                                <!-- Mobile Banking Option -->
                                <div class="border rounded-lg pl-6 py-4 pr-4">
                                    <label class="flex items-center gap-4 mb-6 cursor-pointer">
                                        <input type="radio" name="payment_type" value="mobile_banking" x-model="payment.method" class="w-4 h-4">
                                        <div class="flex gap-4">
                                            <img src="{{ asset('images/default/bkash-nagad.jpg') }}" alt="bKash" class="h-12">
                                        </div>
                                    </label>
                                    <div x-show="payment.method === 'mobile_banking'" class="mt-4 space-y-4">
                                        <p class="font-medium">Pay via Send Money</p>
                                        <p>bKash/Nagad/Rocket: 01705644008</p>
                                        <div>
                                            <p class="font-medium mb-2">Payment Amount: BDT {{ $total_amount }}</p>
                                            <div>
                                                <label class="text-sm mb-1 block">Enter Transaction ID <span class="text-red-500">*</span></label>
                                                <input type="text" name="mobile_transaction_id" class="py-2 px-5 rounded-md w-full border" placeholder="Enter your transaction ID" value="{{ old('mobile_transaction_id') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Transfer Option -->
                                <div class="border rounded-lg pl-6 py-4 pr-4">
                                    <label class="flex items-center gap-4 mb-6 cursor-pointer">
                                        <input type="radio" name="payment_type" value="bank_transfer" x-model="payment.method" class="w-4 h-4">
                                        <img src="{{ asset('images/default/dutch-bangla.png') }}" alt="Dutch-Bangla Bank" class="h-12">
                                    </label>
                                    <div x-show="payment.method === 'bank_transfer'" class="mt-4 space-y-4">
                                        <div class="space-y-2">
                                            <p><span class="font-medium">Account Number:</span> 292.158.0002557</p>
                                            <p><span class="font-medium">Account Name:</span> Salman Md Sultan</p>
                                            <p><span class="font-medium">Bank Name:</span> Dutch Bangla bank limited</p>
                                            <p><span class="font-medium">Branch:</span> khilgaon</p>
                                            <p><span class="font-medium">Routing No:</span> 090273676</p>
                                        </div>
                                        <div>
                                            <p class="font-medium mb-2">Payment Amount: BDT {{ $total_amount }}</p>
                                            <div>
                                                <label class="text-sm mb-1 block">Enter Transaction ID <span class="text-red-500">*</span></label>
                                                <input type="text" name="bank_transaction_id" class="py-2 px-5 rounded-md w-full border" placeholder="Enter your transaction ID">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-end justify-end mb-12 gap-5">
                            <button @click="step = 'shipping'" type="button" class="flex items-center gap-2 py-2 px-5 border rounded-full text-xs font-semibold uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M11.884 6.116a1.25 1.25 0 0 0-1.768 0l-5 5a1.25 1.25 0 0 0 0 1.768l5 5a1.25 1.25 0 0 0 1.768-1.768L9.018 13.25H18a1.25 1.25 0 1 0 0-2.5H9.018l2.866-2.866a1.25 1.25 0 0 0 0-1.768" />
                                </svg>
                                <span>BACK TO SHIPPING</span>
                            </button>
                            <button type="submit" class="flex items-center gap-2 py-2 px-5 border bg-primary text-white rounded-full text-xs font-semibold uppercase">
                                <span>PAY NOW</span>
                            </button>
                        </div>
                    </div>
                    <!-- Pay End -->

                    <!-- Confirmation Start -->
                    <div x-show="step === 'confirmation'" class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
                        <div class="border rounded px-5 md:ps-7 py-10 mb-6 flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="92" height="92" class="mb-6"
                                viewBox="0 0 1200 1200">
                                <path fill="#000"
                                    d="M600 0C268.63 0 0 268.63 0 600s268.63 600 600 600s600-268.63 600-600S931.369 0 600 0m0 130.371c259.369 0 469.556 210.325 469.556 469.629S859.369 1069.556 600 1069.556c-259.37 0-469.556-210.251-469.556-469.556C130.445 340.696 340.63 130.371 600 130.371m229.907 184.717L482.153 662.915L369.36 550.122L258.691 660.718l112.793 112.793l111.401 111.401l110.597-110.669l347.826-347.754z" />
                            </svg>
                            <h3 class="text-center text-xl font-medium mb-2">
                                Congratulation! Your order has been processed.
                            </h3>
                            <p class="text-center text-sm mb-10 text-secondary">
                                Aenean dui mi, tempus non volutpat eget, molestie a orci. Nullam
                                eget sem et eros laoreet rutrum. Quisque sem ante, feugiat quis
                                lorem in.
                            </p>
                            <div>
                                <a href="shop.html"><button
                                        class="flex items-center gpa-2 py-2 px-5 border bg-primary text-white rounded-full text-xs font-semibold uppercase">
                                        <span>RETURN TO STORE</span>
                                    </button></a>
                            </div>
                        </div>
                    </div>
                    <!-- Confirmation End -->
                </div>
            </form>
        </div>
    </section>

    <!-- cHECKOUT End -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const baseTotal = {{ $total_amount }};
            const totalPriceEl = document.getElementById('totalPrice');
            const shippingRadios = document.querySelectorAll('.shipping-radio');
            console.log(typeof fbq);
            // Facebook Pixel - InitiateCheckout event
            if (typeof fbq !== 'undefined') {
                fbq('track', 'InitiateCheckout', {
                    content_ids: [{{ implode(',', $carts->pluck('product.id')->toArray()) }}],
                    content_type: 'product',
                    content_name: ["{{ implode(',', $carts->pluck('product.title')->toArray()) }}"],
                    value: {{ $total_amount }},
                    currency: 'BDT'
                });
            }
            function updateTotal() {
                const selectedShipping = document.querySelector('.shipping-radio:checked');
                const shippingPrice = selectedShipping ? parseFloat(selectedShipping.dataset.price) : 0;
                const newTotal = baseTotal + shippingPrice;
                totalPriceEl.textContent = newTotal;
            }

            shippingRadios.forEach(radio => {
                radio.addEventListener('change', updateTotal);
            });

            // Calculate initial total with default shipping
            updateTotal();
        });
    </script>
</div>




