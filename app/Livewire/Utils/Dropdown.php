<?php

namespace App\Livewire\Utils;

use Illuminate\Support\Facades\Log;
use Livewire\Component;


class Dropdown extends Component
{

    public $label;
    public $data;

    public $selectedItem = '';


    public function mount(
        $label = 'List of vacations',
        $data = [],
        $selectedItem = '',
    )
    {
        $this->label = $label;
        $this->data = $data;
        $this->selectedItem = $selectedItem;
    }

    public function updating($property, $value)
    {
        if($property == 'select'){
            $this->selectedItem = $value;
        }
    }

    public function render()
    {
        return view('livewire.utils.dropdown', [
            'data' => $this->data,
            'selectedItem' => $this->selectedItem,
        ]);
    }




}
