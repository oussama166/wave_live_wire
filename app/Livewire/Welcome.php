<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Welcome extends Component
{

    #[Title('Welcome')]
    public function render()
    {
        return view('livewire.welcome');
    }
}
