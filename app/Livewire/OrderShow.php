<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Order Details')]
class OrderShow extends Component
{
    public $order;

    public function mount($id)
    {
        $this->order = Order::with(['cart_info', 'cart_info.product', 'shipping'])
            ->where('id', $id)
            ->firstOrFail();

        // Check if user has permission to view this order
        if (auth()->user()->id !== $this->order->user_id) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function render()
    {
        return view('livewire.order-show');
    }
}
