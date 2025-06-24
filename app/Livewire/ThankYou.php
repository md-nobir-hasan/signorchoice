<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('View Cart')]

class ThankYou extends Component
{

    public $user;
    protected $order_number;


    public function mount($order_number = null){
        $this->order_number = $order_number;

        //User checking
        $this->user = auth()->user();
        if(!$this->user){
            return $this->redirect(route('user.login'),navigate:false);
        }

    }

    public function toCheckout(){
        return $this->redirect(route('checkout'),navigate:true);
    }

    public function discountCal($discode){
       $coupon= Coupon::where('code',$discode)->first();
        // dd($coupon,$discode);
    return response()->json($coupon);
    }

    public function render()
    {

        $n['order'] = Order::with('cart_info','cart_info.product')->where('order_number',$this->order_number)->first();
        return view('livewire.thank-you',$n);
    }
}
