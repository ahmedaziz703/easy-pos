<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class Error extends Component
{
    public $error = '';

    public function render()
    {
        return view('livewire.error');
    }

    #[On('error')]
    public function error( $error ){
        $this->error = $error;
    }
}   
