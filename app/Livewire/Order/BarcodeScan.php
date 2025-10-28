<?php

namespace App\Livewire\Order;

use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderItem;
use Livewire\Component;

class BarcodeScan extends Component
{
    public $query = '';

    public $error = '';

    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    public function render()
    {
        return view('livewire.order.barcode-scan');
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

        $cartItem  = OrderItem::firstOrCreate(
            [
                'order_id' => $this->orderId, 'product_id' => $product->id
            ],[
                'name' => $product->name, 
                'quantity' => 0, 
                'price' => $product->price, 
                'tax' => $product->tax,
            ]  
        );

        if( ($product->quantity - $quantity) < 0 ){
            $this->error = 'Product Is Out of Stock!';
            if( $cartItem->quantity < 1 ){
                $cartItem->delete();
            }
            return;
        }
        
        $cartItem->update([
            'quantity' => $cartItem->quantity + $quantity
        ]);

        $product->quantity = $product->quantity - $quantity;
        $product->save();

        $this->query = '';

        $this->dispatch('cartUpdated');
    }

    public function closeErrorModal(){
        $this->error = '';
    }
}
