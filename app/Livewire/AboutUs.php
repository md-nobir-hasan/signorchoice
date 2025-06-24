<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('About Us')]

class AboutUs extends Component
{
    public function render()
    {
        // url set to cache for login
        session(['login_previous_url' => request()->url()]);

        return view('livewire.about-us');
    }
}
