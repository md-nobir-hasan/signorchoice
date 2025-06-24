<?php

namespace App\Livewire;

use App\Http\Helper;
use App\Mail\OrderMail;
use App\Mail\OrderMailToAdmin;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Divission;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\UserAddress;
use App\Notifications\StatusNotification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Attributes\Title;
use Notification;
use Illuminate\Support\Str;

#[Title('Order Store')]

class OrderStore extends Component
{
    public $pslug;

    // #[Rule("required", message: "Please, write your first name")]
    // #[Rule("string", message: "Please, enter a valid name")]
    // public $name;

    // #[Rule("required", message: "Please, write your last name")]
    // #[Rule("string", message: "Please, enter a valid name")]
    // public $l_name;

    #[Rule("required", message: "Please, write your address")]
    #[Rule("string", message: "Please, enter a valid address")]
    public $address;

    // #[Rule("required", message: "Please, enter your phone number")]
    // #[Rule("numeric", message: "Please, enter a valid phone number")]
    // public $phone;

    // #[Rule("required", message: "Please, enter an email")]
    // #[Rule("email", message: "Please,Enter a valid email")]
    // // #[Rule("unique:users,email", message: "You have an account. Please, login.")]
    // public $email;

    #[Rule("required", message: "Please, write your city")]
    #[Rule("string", message: "Please, enter a valid city")]
    public $city;

    // #[Rule("required", message: "Please, enter a zone")]
    // #[Rule("exists:divissions,id", message: "Please, Select a valid zone")]
    // public $divission_id;

    // #[Rule("nullable")]
    // #[Rule("string", message: "Please, enter a valid comment")]
    // public $comment;


    #[Rule("required", message: "Please, enter a post code")]
    public $post_code;
    public $payment_method = 'cod';
    public $shipping_id = 1;

    public $err_msg;
    public $payment_possess;

    public $product;



    public function mount()
    {
        $user = auth()->user();

        if(!$user){
            $this->redirect(route('login'), navigate: false);
        }
        // dd(request()->all());

    //    request()->validate([
    //         'address' => 'required|string',
    //         'city' => 'required|string',
    //         'post_code' => 'required',
    //         'mobile_transaction_id' => 'nullable|string|required_if:payment_type,mobile_banking',
    //         'bank_transaction_id' => 'nullable|string|required_if:payment_type,bank_transfer',
    //         // 'payment_method' => 'required|in:cod',
    //     ],[
    //         'mobile_transaction_id.required_without' => 'The transaction id field is required when payment method is mobile banking.',
    //         'bank_transaction_id.required_without' => 'The transaction id field is required when payment method is bank transfer.',
    //     ]);

    try {
        $validated = request()->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'post_code' => 'required',
            'mobile_transaction_id' => 'nullable|string|required_if:payment_type,mobile_banking',
            'bank_transaction_id' => 'nullable|string|required_if:payment_type,bank_transfer',
            'shipping_id' => 'required|exists:shippings,id',
        ], [
            'mobile_transaction_id.required_if' => 'Please, Fill up transaction id.',
            'bank_transaction_id.required_if' => 'Please, Fill up transaction id.',
            'address.required' => 'Please, Fill up Address.',
            'city.required' => 'Please, Fill up City.',
            'post_code.required' => 'Please, Fill up Zip Code.',
            'shipping_id.required' => 'Please, Select a valid shipping method.',
            'shipping_id.exists' => 'Please, Select a valid shipping method.',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        session()->flash('errors', $e->errors());
        return back();
    }

    // dd(request()->all());
     session()->flash('errors', []);
        $user = User::find($user->id);
        $request = request();

        $address =  UserAddress::where('user_id', $user->id)->where('is_default', true)->first();
        $user->address = $request->address;
        $user->city = $request->city;
        $user->post_code = $request->post_code;
        $user->save();

        if (!$address) {
            UserAddress::create([
                'address' => $request->address,
                'city' => $request->city,
                'user_id' => $user->id,
                'post_code' => $request->post_code,
                'is_default' => true,
            ]);
        }

        $carts = Cart::with(['product'])->where('user_id', $user->id)->where('order_id', null)->latest()->get();
        if($carts->count()<1){
            session()->flash('error', "Cart is empty");
            $this->redirect(route('cart'), navigate: false);
        }
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'status' => 'New',
            'installment_count' => 1,
            'quantity' => $carts->count(),
            'transaction_id' => request()->mobile_transaction_id ?: request()->bank_transaction_id,
            'payment_method' => request()->payment_type,
            'shipping_id' => request()->shipping_id,
            'status' => "Pending",
            'payment_status' => 'Unpaid',
        ]);
        if(!$order){
            session()->flash('error', "Order not completed");
            $this->redirect(route('cart'), navigate: false);
        }
        $total_amount = 0;
        $total_product = 0;
        foreach($carts as $cart){
            $cart->order_id = $order->id;
            $cart->save();
            $total_amount += $cart->amount;
            ++$total_product;
        }
        $order->update([
            'amount' => $total_amount,
            'quantity' => $total_product,
        ]);

        return $this->redirect(route('thank_you',[$order->order_number]), navigate: false);
    }

    public function orderSubmit()
    {
        $this->validate();
        if (auth()->user()) {
            $user = auth()->user();
        } else {
            $user = User::firstOrcreate([
                'email' => $this->email,
            ]);

            $address =  UserAddress::where('user_id', $user->id)->where('is_default', true)->first();
            if (!$address) {
                UserAddress::create([
                    'address' => $this->address,
                    'city' => $this->city,
                    'divission_id' => $this->divission_id,
                    'user_id' => $user->id,
                    'is_default' => true,
                ]);
            }
            Auth::login($user);
        }
        //update user
        $user->name = $this->name;
        $user->l_name = $this->l_name;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->city = $this->city;
        $user->divission_id = $this->divission_id;
        $user->save();

        $order = new Order();
        $order_data = $this->all();
        $order_data['order_number'] = 'ORD-' . strtoupper(Str::random(10));
        $order_data['user_id'] = $user->id;
        $order_data['status'] = 'New';
        $final_price = Helper::commaRemove($this->product->final_price);
        $order_data['sub_total'] = $final_price;
        $order_data['amount'] = $final_price;
        $order_data['payable'] = $final_price;
        $order_data['installment_count'] = 1;
        $order_data['inventory_cost'] = Helper::commaRemove($this->product->inventory_cost);
        $order_data['quantity'] = 1;
        $order_data['status'] = "Pending";
        $order_data['payment_status'] = 'Unpaid';
        $order->fill($order_data);
        $status = $order->save();
        $users = User::role('Admin')->get();

        //Mail content
        $mail_content = [
            'order' => $order,
            'sub' => "A new order has been created",
            'view' => 'mail.order-mail-to-admin',
        ];

        // send mail to admin
        foreach ($users as $us) {
            Mail::to($us->email)->send(new OrderMailToAdmin($mail_content));
        }

        // send mail to user
        $mail_content['view'] = 'mail.order-mail-to-user';
        Mail::to($user->email)->send(new OrderMail($mail_content));

        $details = [
            'title' => 'New order created',
            'actionURL' => route('order.show', $order->id),
            'fas' => 'fa-file-alt'
        ];

        Notification::send($users, new StatusNotification($details));
        $product = $this->product;
        Cart::create([
            'product_id' => $product->id,
            'order_id' => $order->id,
            'user_id' => $user->id,
            'ip' => request()->ip(),
            'price' => $order->sub_total,
            'quantity' => 1,
            'amount' => $order->sub_total,
        ]);
        request()->session()->flash('success', 'Your Order successfully placed in order');
        return $this->redirect(route('order.receive', [$order->order_number]));
    }


    public function render()
    {
        if ($coupon_id = Session::get('coupon_id')) {
            $n['coupon'] = Coupon::find($coupon_id);
        } else {
            $n['coupon'] = new Coupon();
        }
        if ($user = Auth()->user()) {
            $n['carts'] = Cart::with(['product'])->where('user_id', $user->id)->where('order_id', null)->latest()->get();
            $address = UserAddress::where('user_id',$user->id)->where('is_default',true)->first();
            $this->name = $user->name;
            $this->l_name = $user->l_name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->address = $address?->address;
            $this->city = $address?->city;
            $this->post_code = $address?->post_code;
            $this->divission_id = $user?->divission_id;
        } else {
            $n['carts'] = Cart::with(['product'])->where('ip', request()->ip())->where('order_id', null)->latest()->get();
        }

        $n['divissions'] = Divission::get();
        $n['shippings'] = Shipping::where('status', 'active')->get();
        return view('livewire.checkout', $n);
    }
}
