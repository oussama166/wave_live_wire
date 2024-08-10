<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class NavigationSideBarAdmin extends Component
{

    public $active;

    public function mount($active)
    {
        $this->active = $active;
    }

    public function render()
    {
        return view('livewire.utils.navigation-side-bar-admin');
    }
}
