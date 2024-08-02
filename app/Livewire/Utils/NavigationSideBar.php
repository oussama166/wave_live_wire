<?php

namespace App\Livewire\Utils;

use Illuminate\Http\Client\Request;
use Livewire\Component;

class NavigationSideBar extends Component
{
    public $active;

    public function mount($active)
    {
        $this->active = $active;
    }
    public function render()
    {
        return view('livewire.utils.navigation-side-bar');
    }
}
