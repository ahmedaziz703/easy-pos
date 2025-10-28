<?php

namespace App\Livewire\Order;

use App\Models\Customer;
use App\Models\Order;
use Livewire\Component;

class CustomerSearch extends Component
{
    public $query = '';  
    public $customers = [];
    public $selectedCustomer = null;
    public $showDropdown = false;  
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $order = Order::find($orderId);
        $this->query = '-';
        $this->selectedCustomer = Customer::find( $order->customer_id );
    }

    public function updatedQuery()
    {
        $this->customers = Customer::where('first_name', 'like', '%' . $this->query . '%')
                            ->orWhere('phone', 'like', '%' . $this->query . '%')
                            ->limit(5)
                            ->get();
        $this->showDropdown = count($this->customers) > 0;
    }


    public function selectCustomer($customerId)
    {
        $customer = Customer::find($customerId);
        if ($customer) {  
            session(['customer_id' => $customer->id]);
            $order = Order::find($this->orderId);
            $order->customer_id = $customer->id;
            $order->save();
            $this->selectedCustomer = $customer;
            $this->showDropdown = false;  
            $this->dispatch('customerSelected', $customerId);
        }
    }


    public function clear(){
        session(['customer_id' => null]);
        $this->selectedCustomer = null;
        $this->query = '';
        $this->dispatch('customerSelected', null);
    }

    public function render()
    {
        return view('livewire.order.customer-search');
    }
}
