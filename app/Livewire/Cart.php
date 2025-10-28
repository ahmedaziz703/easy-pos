<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Attributes\On; 

class Cart extends Component
{
    public $cartItems = [];

    private $currency_symbol;

    public function mount()
    {
        $this->cartItems = CartModel::with('product')
                            ->where('user_id', auth()->user()->id)
                            ->orderBy('id', 'DESC')
                            ->get();    

        $this->currency_symbol = config('settings.currency_symbol');
    }

    
    public function render()
    {
        return view('livewire.cart', ['cartItems' => $this->cartItems, 'currency_symbol' => $this->currency_symbol]);
    }


    #[On('cartUpdated')] 
    public function updateCart()
    {
        $this->cartItems = CartModel::with('product')
                            ->where('user_id', auth()->user()->id)
                            ->orderBy('id', 'DESC')
                            ->get();

        $this->currency_symbol = config('settings.currency_symbol');

    }



    #[On('cartUpdatedFromItem')] 
    public function cartUpdatedFromItem()
    {
        $this->cartItems = CartModel::with('product')
                            ->where('user_id', auth()->user()->id)
                            ->orderBy('id', 'DESC')
                            ->get();

        $this->currency_symbol = config('settings.currency_symbol');

    }


    public function checkout(){
        
        $total_price = 0;
        $customerId =  session('customer_id');

        if( empty($customerId) ){
            return $this->dispatch('error', error: 'Please select customer!');
        }

        $items = $this->cartItems;

        if( ! is_countable( $items ) || count( $items ) < 1){
            return;
        }

        $order = Order::create([
            'customer_id' => $customerId,
            'total_price' => $total_price
        ]);

        

        foreach ($items as $item) {  
            $product = Product::find( $item->product_id );

            $order->items()->create([
                'name' => $item->name,
                'price' => $item->price,
                'tax' => $item->tax,
                'quantity' => $item->quantity,
                'product_id' => $item->product_id,
            ]);
            $total_price += $item->quantity * $item->price;
            $product->quantity = $product->quantity - $item->quantity;
            $product->save();
        }
        
        $order->total_price = $total_price;
        $order->save();

        $this->cartItems = CartModel::where('user_id', auth()->user()->id)
                            ->delete();  

        $this->dispatch('checkout-completed');

        redirect( url('/admin/orders/'. $order->id .'/edit') );

    }

}
