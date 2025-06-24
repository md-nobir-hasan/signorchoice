<div
    class='px-[100px] max-2xl:px-[70px] max-xl:px-[60px] max-lg:px-[38px] max-md:px-[35px] max-sm:px-[15px] max-sm:mt-[10px] max-xl:mt-[100px]'>
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
    <livewire:user-account-menu />
    <div class='h-[2px] bg-[#764A8733]'></div>

    <div class='my-[25px]'>
        <h1 class='text-[20px] text-[#000000] font-[Inter] font-[500] leading-[24.2px]'>Order History</h1>
    </div>

    <div class="overflow-auto rounded-lg shadow">
        <table class="w-full max-sm:w-[750px]">
            <thead class="bg-[#380D37]">
                <tr>
                    <th class="w-20 p-3 tracking-wide text-left text-[14px] text-[#FFFFFF] font-[jost] font-[500]">
                       Order ID
                    </th>
                    <th class="w-20 p-3 tracking-wide text-left text-[14px] text-[#FFFFFF] font-[jost] font-[500]">
                       Order Date
                    </th>
                    <th class="w-20 p-3 tracking-wide text-left text-[14px] text-[#FFFFFF] font-[jost] font-[500]">
                        Product Quantity
                    </th>
                    <th class="w-20 p-3 tracking-wide text-left text-[14px] text-[#FFFFFF] font-[jost] font-[500]">
                        Shipping Charge
                    </th>
                    <th class="w-20 p-3 tracking-wide text-left text-[14px] text-[#FFFFFF] font-[jost] font-[500]">
                        Total Amount
                    </th>
                    <th class="w-20 p-3 tracking-wide text-left text-[14px] text-[#FFFFFF] font-[jost] font-[500]">
                        Payment Status
                    </th>
                    <th class="w-20 p-3 tracking-wide text-left text-[14px] text-[#FFFFFF] font-[jost] font-[500]">
                        Order Status
                    </th>
                    <th class="w-20 p-3 tracking-wide text-left text-[14px] text-[#FFFFFF] font-[jost] font-[500]">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="border-b-[1px] border-[#380D37]">
                @foreach ($orders as $order)
                        {{-- @foreach ($order->cart_info as $cart) --}}
                            <tr>
                                <td
                                    class="p-3 tracking-wide text-left text-[14px] whitespace-nowrap text-[#000000] font-[jost] font-[500]">
                                    {{ $order->order_number }}
                                </td>
                                <td
                                    class="p-3 tracking-wide text-left text-[14px] whitespace-nowrap text-[#000000] font-[jost] font-[500]">
                                    {{ $order->created_at?->timezone(env('APP_TIMEZONE'))->format('d M Y h:i A') }}
                                </td>
                                <td
                                    class="p-3 tracking-wide text-left text-[14px] whitespace-nowrap text-[#000000] font-[jost] font-[500]">
                                        {{ $order->cart_info?->count() }}</td>
                                <td
                                    class="p-3 tracking-wide text-left text-[14px] whitespace-nowrap text-[#000000] font-[jost] font-[500]">
                                    <span class="bg-[#F2F2F2] px-8 py-2">{{ $order->shipping?->price }}</span>
                                </td>
                                <td
                                    class="p-3 tracking-wide text-left text-[14px] whitespace-nowrap text-[#000000] font-[jost] font-[500]">
                                    {{ number_format($order->totalAmount(), 2) }}৳</td>
                                <td
                                    class="p-3 tracking-wide text-left text-[14px] whitespace-nowrap text-[#000000] font-[jost] font-[500]">
                                    {{ $order->payment_status }}
                                </td>
                                <td
                                    class="p-3 tracking-wide text-left text-[14px] whitespace-nowrap text-[#000000] font-[jost] font-[500]">
                                    @if ($order->status == 'Pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $order->status }}</span>
                                    @elseif($order->status == 'Shipped')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{ $order->status }}</span>
                                    @elseif($order->status == 'Delivered')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $order->status }}</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $order->status }}</span>
                                    @endif
                                </td>
                               <td >
                                    <a href="{{ route('oc.show', $order->id) }}"

                                        title="Show">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                               </td>
                            </tr>
                        {{-- @endforeach --}}
                    {{-- @endif --}}
                @endforeach
            </tbody>
        </table>
        {{-- {{ $orders->links() }} --}}
    </div>
    <div class='h-[2px] bg-[#764A8733] mt-[200px]'></div>
</div>
