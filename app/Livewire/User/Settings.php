<?php

namespace App\Livewire\User;

use Livewire\Attributes\Title;
use Livewire\Component;

class Settings extends Component
{
    #[Title('Settings')]
    public function render()
    {
        return view('livewire.user.settings');
    }
}
