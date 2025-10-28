<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Cart;
use Livewire\Attributes\On; 

class ProductSearch extends Component
{
    public $query = '';
    public $products = '';

    public function mount()
    {
        $this->products = Product::where('name', 'like', '%' . $this->query . '%')->limit(10)->get();
    }

    public function render()
    {
        $currency_symbol = config('settings.currency_symbol');
    
        return view('livewire.product-search', compact('currency_symbol'));
    }

    #[On('checkout-completed')]
    public function checkoutCompleted(){
        $this->query = '';
    }

    #[On('cartUpdated')]
    public function updateCart()
    { 
    }

    public function updated(){
        $this->products = Product::where('name', 'like', '%' . $this->query . '%')->limit(10)->get();
    }

    public function addToCart( $product_id, $quantity = 1 ){

        $product  = Product::find( $product_id );
        $user_id  = auth()->user()->id;
        $cartItem = Cart::firstOrCreate(
            [
                'user_id' => $user_id, 'product_id' => $product_id
            ],  
            [
                'quantity' => 0, 
                'name' => $product->name, 
                'price' => $product->price,
                'tax' => $product->tax
            ] 
        );

        if( $product->quantity < ($cartItem->quantity + $quantity) ){
            if($cartItem->quantity < 1 ){
                $cartItem->delete();
            }
            return;
        }
        
        $cartItem->update([
            'quantity' => $cartItem->quantity + $quantity
        ]);

        $this->dispatch('cartUpdated');
    }

}
