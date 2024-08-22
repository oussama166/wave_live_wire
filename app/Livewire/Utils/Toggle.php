<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class Toggle extends Component
{
    public $size = "md";
    public $name;

    public function mount($size = "md", $name = "toggle"){
        $this->size = $size;
        $this->name = $name;
    }
    public function render()
    {
        return view('livewire.utils.toggle');
    }
}
