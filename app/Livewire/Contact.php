<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Contact')]

class Contact extends Component
{


    public function render()
    {
        return view('livewire.contact');
    }
}
