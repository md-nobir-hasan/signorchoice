<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductReview;
use App\Notifications\StatusNotification;
use App\User;
use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Rule;
use Notification;

class OrderReviewModal extends ModalComponent
{
    public $product_id;
    public $product;

    #[Rule('required|integer|min:1|max:5', message: 'Please select a rating')]
    public $rating = 5;

    #[Rule('required|string|min:10', message: 'Review must be at least 10 characters')]
    public $review = '';

    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $this->product = Product::findOrFail($product_id);
    }

    public function submitReview()
    {
        $this->validate();

        $user = auth()->user();

        // Check if review already exists
        $existingReview = ProductReview::where([
            'user_id' => $user->id,
            'product_id' => $this->product_id,
        ])->first();

        // if (!$existingReview) {
            $status = ProductReview::create([
                'user_id' => $user->id,
                'product_id' => $this->product_id,
                'rate' => $this->rating,
                'review' => $this->review,
                'status' => 'active',
                'f_name' => $user->name,
                'l_name' => '',
                'ip' => request()->ip()
            ]);

            if ($status) {
                // Notify admin about new review
                $this->js("alert('Thank you for your review!')");
            } else {
                $this->js("alert('Something went wrong. Please try again.')");
            }
        // } else {
        //     $this->dispatch('notify', [
        //         'type' => 'error',
        //         'message' => 'You have already reviewed this product'
        //     ]);
        // }

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.order-review-modal');
    }
}
