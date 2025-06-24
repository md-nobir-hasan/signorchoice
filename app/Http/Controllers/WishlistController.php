<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
class WishlistController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function wishlist(Request $request){
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        $product = Product::where('slug', $request->slug)->first();
        if (empty($product)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid product'
            ]);
        }

        $already_wishlist = Wishlist::where('user_id', auth()->user()->id)
            ->where('cart_id', null)
            ->where('product_id', $product->id)
            ->first();

        if($already_wishlist) {
            $already_wishlist->delete();
            $wishlistCount = Wishlist::where('product_id', $product->id)->count();
            return response()->json([
                'success' => true,
                'message' => 'Removed from wishlist',
                'wishlistCount' => $wishlistCount
            ]);
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = auth()->user()->id;
        $wishlist->product_id = $product->id;
        $wishlist->price = ($product->price-($product->price*$product->discount)/100);
        $wishlist->quantity = 1;
        $wishlist->amount = $wishlist->price * $wishlist->quantity;
        $wishlist->save();

        $wishlistCount = Wishlist::where('product_id', $product->id)->count();

        return response()->json([
            'success' => true,
            'message' => 'Added to wishlist',
            'wishlistCount' => $wishlistCount
        ]);
    }

    public function wishlistDelete(Request $request){
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
            request()->session()->flash('success','Wishlist successfully removed');
            return back();
        }
        request()->session()->flash('error','Error please try again');
        return back();
    }
}
