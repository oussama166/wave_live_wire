<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('User Dashboard')]
    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
