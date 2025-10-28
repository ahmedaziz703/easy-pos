<div>
    <input wire:model="query" 
    wire:keydown.escape="closeErrorModal" 
    wire:keydown.enter="addToCart" class="p-2 bg-white block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="البحث عن باركورد..." />
   
    @if($error)
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-600 bg-opacity-50 transition-opacity duration-500 ease-in-out" 
        style="display: {{ $error ? 'flex' : 'none' }}; opacity: {{ $error ? '1' : '0' }};">
        <!-- Modal Container -->
        <div wire:click.outside="$set('error', false)" 
            class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full opacity-0 transform transition-all duration-300 ease-in-out 
                    {{ $error ? 'opacity-100 scale-100' : 'opacity-0 scale-95' }}">
            <div class="text-center">
                <h2 class="text-xl font-semibold mb-4">Error!</h2>
                <p class="text-gray-700 mb-4">{{ $error }}</p>
                <button wire:click="$set('error', false)" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                    Close
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
