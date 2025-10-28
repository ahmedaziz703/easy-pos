<tr class="odd:bg-white even:bg-gray-100">
    <td class="px-2 py-1 border-r dark:text-gray-800 min-w-[200px] max-w-[400px] whitespace-normal break-words"">{{ $cartItem->name }}</td>
    <td class="px-2 py-1 border-r text-center dark:text-gray-800">{{ number_format($cartItem->price, 2) }}</td>
    <td class="px-2 py-1 border-r text-center dark:text-gray-800">{{ $cartItem->tax }}</td>
    <td class="px-2 py-1 border-r text-center dark:text-gray-800">
        <div class="flex items-center gap-1 dark:text-gray-800 w-32">
            <input type="number" min="1" wire:model.live.debounce.250ms="quantity"  class="p-1 bg-white text-center block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <button wire:click="removeFromCart"  wire:loading.attr="disabled" class="p-2 text-white bg-red-500 rounded hover:bg-red-600" title="Delete">
                <svg wire:loading.remove wire:target='removeFromCart'  xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span wire:loading wire:target='removeFromCart'  class="w-4 h-4 border-2 border-t-red-100 border-transparent rounded-full animate-spin"></span>
            </button>
        </div>
    </td>
    @php
        $item_total = $cartItem->price * $cartItem->quantity;
        $tax_amount = ($item_total * $cartItem->tax) / 100;
        $item_total_with_tax = $item_total + $tax_amount;
    @endphp
    <td class="px-2 py-1 text-center">{{ number_format($item_total_with_tax , 2, '.', '') }}</td>
</tr>
