<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FloatingWhatsApp extends Component
{
    public $phoneNumber;
    public $message;

    /**
     * Create a new component instance.
     */
    public function __construct($phoneNumber = null, $message = null)
    {
        $this->phoneNumber = $phoneNumber ?? config('services.whatsapp.number', '');
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.floating-whats-app');
    }
}
