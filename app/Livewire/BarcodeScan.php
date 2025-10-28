<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Cart;
use Livewire\Component;

class BarcodeScan extends Component
{
    public $query = '';

    public $error = '';

    public function render()
    {
        return view('livewire.barcode-scan');
    }


    public function addToCart(){

        if( empty($this->query) ){
            return;
        }
        
        $this->error = '';
        $quantity = 1;
        $product = Product::where('barcode', $this->query)->first();
        
        if( !$product ){
            $this->error = 'The '. $this->query . ' ' . ' - Product which does not exist!';
            $this->query = '';
            return;
        }
        $user_id  = auth()->user()->id;
        $cartItem = Cart::firstOrCreate(
            [
                'user_id' => $user_id, 'product_id' => $product->id
            ],  
            [  
                'name' => $product->name, 
                'quantity' => 0, 
                'price' => $product->price,
                'tax' => $product->tax
            ] 
        );

        

        if( $product->quantity < ($cartItem->quantity + $quantity) ){
            $this->error = 'Product Is Out of Stock!';
            if($cartItem->quantity < 1 ){
                $cartItem->delete();
            }
            return;
        }
        
        $cartItem->update([
            'quantity' => $cartItem->quantity + $quantity
        ]);

        $this->query = '';

        $this->dispatch('cartUpdated');
    }

    public function closeErrorModal(){
        $this->error = '';
    }
}
