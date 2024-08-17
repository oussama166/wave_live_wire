<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;

class Profiles extends Component
{
    public function redirectToCreate()
    {
        return redirect()->route('Admin.create');
    }

    #[Title("Profiles ")]
    public function render()
    {
        return view('livewire.admin.profiles');
    }
}
