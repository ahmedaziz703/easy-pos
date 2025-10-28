<x-filament-panels::page>
    
    <div class="flex flex-col md:flex-row gap-2" x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-print'))]"
        x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('filament-print-js'))]"
    >
        
        <div class="w-full md:w-1/3 md:order-2">
            <livewire:order.product-search :order-id="$this->record->id" />
        </div>

        <div class="w-full md:w-2/3 md:order-1">
            <div class="flex flex-col md:flex-row gap-4 pb-4">
                <div class="w-full md:w-1/2"> 
                    <livewire:order.barcode-scan :order-id="$this->record->id" />
                </div>
                <div class="w-full md:w-1/2">
                    <livewire:order.customer-search :order-id="$this->record->id" />
                </div>
            </div>
            <livewire:order.cart :order-id="$this->record->id" />
        </div>

    </div> 

    <livewire:error />  

</x-filament-panels::page>
