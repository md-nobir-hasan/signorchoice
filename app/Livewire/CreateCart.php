<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Create Cart')]

class CreateCart extends Component
{

    public $user;
    public $slug;
    public $product;

    public function mount($slug = null){
        $this->slug = $slug;

        //User checking
        $this->user = auth()->user();
        if(!$this->user){
            return $this->redirect(route('user.login'),navigate:false);
        }

        $this->product = Product::where('slug', $this->slug)->first();
        // return $product;
        if (empty($this->product)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $already_cart = Cart::where('user_id', $this->user->id)->where('order_id',null)->where('product_id', $this->product->id)->first();
        // return $already_cart;
        if($already_cart) {
            // dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $this->product->price + $already_cart->amount;
            // return $already_cart->quantity;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0)
            {
                session()->flash('error','Stock not sufficient!.');
                return $this->redirect(route('vcart'),navigate:false);
            }
            $already_cart->save();

        }else{
           $size = ProductSize::find(request()->size_id);
        //    dd(request()->all(),$size);
           if(!$size){
            session()->flash('error','Please select size!.');
            return $this->redirect(route('vcart'),navigate:false);
           }
            $cart = new Cart;
            $cart->user_id = $this->user->id;
            $cart->product_id = $this->product->id;
            $cart->color_id = request()->color_id;
            $cart->size_id = $size->id;
            $cart->price = $size->price;
            $cart->discount = $size->discount;
            $cart->quantity = request()->quant;
            $cart->amount = ($size->price - $size->discount) * request()->quant;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0)
            {
                session()->flash('error','Stock not sufficient!.');
                return $this->redirect(route('vcart'),navigate:false);
            }
            $cart->save();
            $wishlist=Wishlist::where('user_id',$this->user->id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }

        $this->redirect(route('vcart'),navigate:false);

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

        $n['carts'] = Cart::with('product')->where('user_id',$this->user->id)->where('order_id', null)->latest()->get();
        return view('livewire.view-cart',$n);
    }
}
