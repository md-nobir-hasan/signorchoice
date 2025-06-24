<div>
    <!-- cHECKOUT Start -->

    <section class="pb-20">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">

            <x-broadcam>
                <span>Order Completed</span>
            </x-broadcam>
            <x-page-title>
                <span>Order Completed</span>
            </x-page-title>
        </div>

        <div>
            <!-- Confirmation Start -->
            <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
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
                        <a href="{{ route('home') }}">
                            <span
                                class="flex items-center cursor-pointer gpa-2 py-2 px-5 border bg-primary text-white rounded-full text-xs font-semibold uppercase">
                                <span>RETURN TO STORE</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Confirmation End -->
        </div>


    </section>

    <!-- cHECKOUT End -->
    <script>
        // Facebook Pixel - Purchase event
        if (typeof fbq !== 'undefined') {
            const orderItems = @json($order->cart_info);
            const contents = [];

            orderItems.forEach(cart => {
                contents.push({
                    id: cart.product.id,
                    product_name: cart.product.title,
                    quantity: cart.quantity,
                    price: cart.price,
                    name: cart.product.title,
                    variant: cart.size?.size,
                    color: cart.color?.color
                });
            });

            fbq('track', 'Purchase', {
                content_type: 'product',
                value: "{{ $order->amount }}",
                currency: 'BDT',
                contents: contents
            });
        }
    </script>

</div>

