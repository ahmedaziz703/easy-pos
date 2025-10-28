<div class="">

    @if (session()->has('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif
    <div class="overflow-x-auto md:overflow-x-none">
        <table class="min-w-[600px] min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-2 py-1 border border-gray-400 text-left w-3/5 dark:text-gray-800">المنتج</th>
                    <th class="px-2 py-1 border border-gray-400 text-center w-1/6 dark:text-gray-800">السعر</th>
                    <th class="px-2 py-1 border border-gray-400 text-center w-1/6 dark:text-gray-800">الضريبة(%)</th>
                    <th class="px-2 py-1 border border-gray-400 text-center w-1/6 dark:text-gray-800">الكمية</th>
                    <th class="px-2 py-1 border border-gray-400 text-center w-1/6 dark:text-gray-800">الاجمالي</th>
                </tr>
            </thead>
            <tbody>
            @if ( !is_countable($cartItems) || count($cartItems) < 1)
                <tr class="min-h-32"><td class="p-4">أضف منتجات.</td></tr>
            @else
                @php 
                    $total_price = 0;
                    $total_tax = [];
                    $grand_total = 0;
                @endphp
                
                @foreach ($cartItems as $item) 
                @php 
                    $tax = $item->tax;
                    $item_total = $item->price * $item->quantity;
                    $gst_amount = ($item_total * $tax) / 100;
                    $item_total_with_gst = $item_total + $gst_amount;
                    $total_price += $item_total;
                    $total_tax[$tax] = ($total_tax[$tax] ?? 0) + $gst_amount;
                    $grand_total += $item_total_with_gst;
                    $item->item_total_with_gst = $item_total_with_gst;
                @endphp
                    <livewire:order.cart-item :cartItem="$item" :currency_symbol="$currency_symbol" :order-id="$orderId" :key="$item->id" />
                @endforeach
                
                <tr class="border-gray-400 border">
                    <td colspan="3" class="px-4 py-2 border-r text-right font-semibold">المجموع الفرعي</td>
                    <td colspan="2" class="px-4 py-2 text-center font-semibold">{{ $currency_symbol }}{{ number_format($total_price, 2) }}</td>
                </tr>

                @foreach ($total_tax as $rate => $amount)
                    <tr class="border-gray-400 border">
                        <td colspan="3" class="px-4 py-2 border-r text-right font-semibold">ضريبة القيمه المضافة @ {{ $rate }}%</td>
                        <td colspan="2" class="px-4 py-2 text-center font-semibold">{{ $currency_symbol }}{{ number_format($amount, 2) }}</td>
                    </tr>
                @endforeach

                <tr class="bg-gray-100 border-gray-400 border">
                    <td colspan="3" class="px-4 py-2 border-r text-right font-bold">المجموع الكلي</td>
                    <td colspan="2" class="px-4 py-2 text-center font-bold">{{ $currency_symbol }}{{ number_format($grand_total, 2) }}</td>
                </tr>

            @endif
            </tbody>
        </table>
    </div>

    <button wire:click="checkout" class="bg-green-500 rounded  text-white px-4 py-2 mt-3">
        <svg class="size-6 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>              
    </button>

</div>
