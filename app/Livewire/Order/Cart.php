<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Attributes\On; 

class Cart extends Component
{
    public $cartItems = [];

    private $currency_symbol;

    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;  

        $this->cartItems = OrderItem::where('order_id', $orderId)            
                            ->orderBy('id', 'DESC')
                            ->get();    
        $this->currency_symbol = config('settings.currency_symbol');
    }

    
    public function render()
    {
        $this->currency_symbol = config('settings.currency_symbol');
        return view('livewire.order.cart', ['cartItems' => $this->cartItems, 'currency_symbol' => $this->currency_symbol]);
    }


    #[On('cartUpdated')]
    public function updateCart()
    {
        $this->cartItems = OrderItem::where('order_id', $this->orderId)            
                                        ->orderBy('id', 'DESC')
                                        ->get();

        $order = Order::find($this->orderId);
        
        $total_price = 0;
        foreach($this->cartItems as $item){ 
            $total_price += $item->quantity * $item->price;
        }
        $order->total_price = $total_price;
        $order->save();

    }


    #[On('cartUpdatedFromItem')] 
    public function cartUpdatedFromItem()
    {
        $this->cartItems = OrderItem::where('order_id', $this->orderId)            
                                        ->orderBy('id', 'DESC')
                                        ->get();

        $order = Order::find($this->orderId);

        $total_price = 0;
        foreach($this->cartItems as $item){ 
            $total_price += $item->quantity * $item->price;
        }
        $order->total_price = $total_price;
        $order->save();
                                
    }


    public function checkout(){ 
        return $this->redirect( url('admin/orders') );
    }

}
