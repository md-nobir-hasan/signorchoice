<?php

namespace App\Livewire;

use App\Models\Video as ModelsVideo;
use Livewire\Component;
use Livewire\Attributes\Title;
#[Title('Videos')]

class Video extends Component
{
    public function render()
    {
        $n['videos'] = ModelsVideo::orderBy('serial','desc')->paginate(20);

        return view('livewire.video',$n);
    }
}
