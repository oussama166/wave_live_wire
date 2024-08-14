<?php

namespace App\Livewire\Utils;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Dropdown extends Component
{
    public $label;
    public $data;
    public $selectedItem;
    public $selectArea;
    public $index;

    public function mount(
        $label = 'List of vacations',
        $data = [],
        $selectedItem = '',
        $selectArea = 'selectArea',
        $index="label"
    ) {
        $this->label = $label;
        $this->data = $data;

        $this->selectedItem = $selectedItem;

        $this->selectArea = $selectArea;
        $this->index = $index;

    }

    public function updating($property, $value)
    {
        if ($property == 'select') {
            $this->selectedItem = $value;
        }
    }

    public function render()
    {
        return view('livewire.utils.dropdown', [
            'data' => $this->data
        ]);
    }
}
