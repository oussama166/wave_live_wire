<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;

class Profiles extends Component
{
    #[Title("Profiles ")]
    public function render()
    {
        return view('livewire.admin.profiles');
    }
}
