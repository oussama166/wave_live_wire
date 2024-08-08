<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class Toggle extends Component
{
    public $size = "md";

    public function mount($size = "md"){
        $this->size = $size;
    }
    public function render()
    {
        return view('livewire.utils.toggle');
    }
}
