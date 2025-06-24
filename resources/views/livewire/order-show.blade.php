<div class="px-[100px] max-2xl:px-[70px] max-xl:px-[60px] max-lg:px-[38px] max-md:px-[35px] max-sm:px-[15px] max-sm:mt-[10px] max-xl:mt-[100px]">
    <livewire:user-account-menu />
    <div class='h-[2px] bg-[#764A8733]'></div>

    <div class='my-[25px]'>
        <h1 class='text-[20px] text-[#000000] font-[Inter] font-[500] leading-[24.2px]'>Order Details</h1>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- Order Summary -->
        <div class="mb-6">
            <h2 class="text-lg font-medium mb-4">Order Summary</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Order Number</p>
                    <p class="font-medium">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Order Date</p>
                    <p class="font-medium">{{ $order->created_at?->timezone(env('APP_TIMEZONE'))?->format('d M Y h:i A') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Payment Status</p>
                    <p class="font-medium">{{ $order->payment_status }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Order Status</p>
                    <p class="font-medium">{{ $order->status }}</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-6">
            <h2 class="text-lg font-medium mb-4">Order Items</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Product</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Price</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Discount</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Quantity</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Total</th>
                            <th class="px-4 py-2  text-sm font-medium text-gray-500 text-center">Review</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php

                            $sub_total = 0;
                        @endphp
                        @foreach($order->cart_info as $item)
                        @php
                            $sub_total += $item->totalAmount();
                        @endphp

                            <tr>
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <img src="{{ $item->product->thumbnail_url }}" alt="{{ $item->product->title }}" class="w-16 h-16 object-cover rounded">
                                        <div class="ml-4">
                                            <p class="font-medium">{{ $item->product->title }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-4">{{ number_format($item->price, 2) }}৳</td>
                                <td class="px-4 py-4">{{ number_format($item->discount, 2) }}৳</td>
                                <td class="px-4 py-4">{{ $item->quantity }}</td>
                                <td class="px-4 py-4">{{ number_format($item->totalAmount(), 2) }}৳</td>
                                <td>
                                     <!-- Add this after the Order Items table section -->
                                    @if ($order->status == 'Delivered')
                                        <div class="flex justify-end mb-4">
                                            <button type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-[#380D37] text-white rounded-md hover:bg-[#380D37]/80"
                                                    onclick="Livewire.dispatch('openModal', { component: 'order-review-modal', arguments: { product_id: '{{ $item->product_id }}' }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                Write a Review
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Order Totals -->
        <div class="mb-6">
            <h2 class="text-lg font-medium mb-4">Order Totals</h2>
            <div class="border rounded-lg p-4">
                <div class="flex justify-between py-2">
                    <span>Subtotal</span>
                    <span>{{ number_format($sub_total, 2) }}৳</span>
                </div>
                <div class="flex justify-between py-2">
                    <span>Shipping</span>
                    <span>{{ number_format($order->shipping?->price ?? 0, 2) }}৳</span>
                </div>
                <div class="flex justify-between py-2 font-medium">
                    <span>Total</span>
                    <span>{{ number_format($order->totalAmount(), 2) }}৳</span>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('oc') }}" class="inline-flex items-center text-[#380D37] hover:text-[#380D37]/80">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Orders
            </a>
        </div>
    </div>
</div>
