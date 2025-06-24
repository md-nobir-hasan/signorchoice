<?php

namespace App\Livewire;

use App\Models\Banner;
use App\Models\Category;
use App\Models\CompanyReview;
use App\Models\OtherSetting;
use App\Models\Post;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class HomePage extends Component
{
    #[Rule("required", message: "Please,Enter a email")]
    #[Rule("email", message: "Please,Enter a valid email")]
    public $email;

    #[Rule("required", message: "Please,Enter a name")]
    #[Rule("string", message: "Name contain only letter and space")]
    public $name;
    // use WithPagination;

    // public $email;
    public $subject;

    #[Rule("required", message: "Please, Write a message")]
    #[Rule("string", message: "Message should be contain only letter and space")]
    public $msg;

    public $user_id;
    public $post_success_msg;
    public $post_error_msg;


    public function mount()
    {
        // dd(auth()->user());
        if ($user = auth()->user()) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->user_id = $user->id;
        }

        // url set to cache for login
        session(['login_previous_url' => request()->url()]);
    }

    public function post()
    {

        $this->validate();
        // dd($this->name,$this->email,$this->subject,$this->msg);
        $insert = CompanyReview::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'msg' => $this->msg,
            'user_id' => $this->user_id,
        ]);

        if ($insert) {
            $this->post_success_msg = 'Your post is successfully submitted';
            $this->name = '';
            $this->email = '';
            $this->subject = '';
            $this->msg = '';
            $this->user_id = '';
        } else {
            $this->post_error_msg = "Something went wrong";
        }
    }

    public function render()
    {
        $os = OtherSetting::first();

        //banner products
        $n['banner_products'] = Product::bannerProducts()->get();

        //Static Offer Banner
        $n['offer_banner'] = Banner::where('status','active')
                                        ->limit(2)
                                        ->orderBy('id','desc')
                                        ->get();

        //deal of the day
        $n['deal_of_the_day'] = Product::where('status','active')
                                        ->where('is_featured',true)
                                        ->get();

        //best collection
        $n['best_collection'] = Product::bestCollections()->latest()->get()->take(2);

        //collection arrived
        $n['collection_arrived'] = Product::collectionArrival()->latest()->first();

        //new arrivals
        $n['new_arrivals'] = Product::where('status','active')
                                    ->orderBy('serial','desc')
                                    ->get()
                                    ->take(10);

        //top rated
        $n['top_rated'] = Product::topRated()->latest()->get()->take(10);

        //best sellers
        $n['bestsellers'] = Product::bestSellers()->latest()->get()->take(10);


        // instagram products
        $n['instagram_products'] = Product::instagramProducts()->latest()->get()->take(10);


        // lates news
        $n['latest_news'] = Post::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();


        if (auth()->user()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
        return view('livewire.home-page', $n);
    }
}
