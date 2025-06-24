<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('View Cart')]

class ViewCart extends Component
{

    public $user;


    public function mount($slug = null){
        $this->slug = $slug;

        // url set to cache for login
        session(['login_previous_url' => request()->url()]);

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

        if($coupon_id = Session::get('coupon_id')){
            $n['coupon'] = Coupon::find($coupon_id);
        }else{
            $n['coupon'] = 0;
        }

        $n['carts'] = Cart::with('product','size','color','size.size','color.color')->where('user_id',$this->user->id)->where('order_id', null)->latest()->get();
        return view('livewire.view-cart',$n);
    }
}
