
<div class="mx-auto">   
    <div class="relative">
        <input wire:model.live.debounce.250ms="query" type="search" id="default-search" class="p-2 bg-white block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="البحث عن منتج..." />
    </div>
    <div class="mt-4">
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-2">
            @php $counter = 0; @endphp
            @foreach ($products as $product)
            <div wire:click="addToCart({{$product->id}})" class="relative bg-white border border-gray-300 rounded  {{ $counter > 1 ? 'hidden md:block' : '' }}">

                <div wire:loading wire:target="addToCart({{ $product->id }})"  class="bg-gray-200 bg-opacity-80 absolute p-2 w-full h-full text-red-500" >
                    <svg class="absolute h-12 w-12 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" viewBox="0 0 120 30" fill="currentColor">
                        <circle cx="15" cy="15" r="10" fill="red">
                            <animate attributeName="opacity" values="0;1;0" dur="1.5s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="60" cy="15" r="10" fill="red">
                            <animate attributeName="opacity" values="0;1;0" dur="1.5s" repeatCount="indefinite" begin="0.3s"/>
                        </circle>
                        <circle cx="105" cy="15" r="10" fill="red">
                            <animate attributeName="opacity" values="0;1;0" dur="1.5s" repeatCount="indefinite" begin="0.6s"/>
                        </circle>
                    </svg>
                </div>

                <img src="{{$product->getImageUrl()}}" alt="Product 1" class="object-contain max-h-full">
                <p class="text-gray-600 p-2 text-sm">{{$product->name}} ({{$product->quantity}})</p>
                <p class="text-gray-600 p-2 pt-0 text-md">{{$currency_symbol .  $product->price}}</p>
                @if($product->quantity < 1)
                <div class="absolute top-1 right-1 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                    Out of Stock
                </div>
                @endif
            </div> 
                @php $counter++; @endphp
            @endforeach
        </div>
    </div>
</div>
