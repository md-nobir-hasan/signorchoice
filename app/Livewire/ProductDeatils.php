<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\RecentViewedProduct;
use App\Models\Wishlist;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Product Details')]

class ProductDeatils extends Component
{
    public $slug;
    public $isWishlisted = false;
    public $product;

    public $payment_process = 'one_time';

    // #[Rule("required", message: "Please, enter a name")]
    // #[Rule("string", message: "Please, enter a valid name")]
    // public $f_name;

    // #[Rule("required", message: "Please, enter a name")]
    // #[Rule("string", message: "Please, enter a valid name")]
    // public $l_name;

    // #[Rule("required", message: "Please, write a message")]
    // #[Rule("string", message: "Please, write a valid message")]
    // public $msg;

    // #[Rule("required", message: "Please, upload a image")]
    // public $img;

    // #[Rule("required", message: "Please, give review")]
    // public $review_star;

    // public function review(){
    //     $this->validate();
    //     // dd($this);
    // }
    public function checkout($slug)
    {
        // dd($this->payment_process);
        if($this->payment_process == 'installment'){
            return $this->redirect(route('installment_checkout', [$slug]), navigate: true);
        }
        // dd($this->payment_process);
        return $this->redirect(route('single_checkout', [$slug]), navigate: true);
    }

    public function mount($slug)
    {


       $product = Product::with('cat_info', 'sub_cat_info', 'brand', 'sizes', 'sizes.size', 'colors', 'colors.color','wishlists')
                ->where('slug', $this->slug)
                ->where('is_showable_to_user',1)
                ->first();

        $this->product = $product;

        // url set to cache for login
        session(['login_previous_url' => request()->url()]);

       //increase views
         $product->update([
            'views' => $product->views + 1,
        ]);

        // added as recent view product
        if ($user = auth()->user()) {
            RecentViewedProduct::firstOrCreate([
                'product_id' => $product->id,
                'user_id' => $user->id,
            ]);
        } else {
            RecentViewedProduct::firstOrCreate([
                'product_id' => $product->id,
                'ip' => request()->ip(),
            ]);
        }

    }
    public function render()
    {

        // $n['product'] = Product::with('cat_info', 'sub_cat_info', 'brand', 'sizes', 'sizes.size', 'colors', 'colors.color')
        //                 ->where('slug', $this->slug)
        //                 ->where('is_showable_to_user',1)
        //                 ->first();
        $n['recent_views'] = RecentViewedProduct::get();
        $n['product_reviews'] = ProductReview::with('images')
                                ->where('product_id', $this->product->id)
                                ->where('status', 'active')
                                ->get();
        $n['related_products'] = Product::where('status', 'active')
                                    ->where('cat_id', $this->product->cat_id)
                                    // ->where('is_showable_to_user',1)
                                    ->where('id', '!=', $this->product->id)
                                    ->get();
        return view('livewire.product-deatils', $n);
    }
}
