<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Order Confirm')]

class OrderConfirm extends Component
{
    public function render()
    {

        $n['orders'] = Order::with(['order_status', 'shipping'])
                        ->where('user_id', auth()->user()->id)
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        return view('livewire.order-confirm',$n);
    }
}
