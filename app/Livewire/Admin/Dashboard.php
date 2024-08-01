<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title("User dashboard")]
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
