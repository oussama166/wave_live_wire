<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class DropDownMenue extends Component
{
    public $title = "action";
    public $customStyleButton = "";

    public function render()
    {
        return view('livewire.utils.drop-down-menue');
    }
}
