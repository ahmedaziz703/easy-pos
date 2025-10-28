<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerSearch extends Component
{
    public $query = '';  
    public $customers = [];
    public $selectedCustomer = null;
    public $showDropdown = false;  

    public function mount(){
        $customerId = session('customer_id');
        if( $customerId ){
            $this->selectedCustomer = Customer::find( $customerId );
            $this->query = '-';  
        }
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
        return view('livewire.customer-search');
    }
}
