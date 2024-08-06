<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class FormDatePicker extends Component
{
    public $firstTitle;
    public $secondTitle;
    public $firstModel;
    public $secondModel;

    public function mount(
        $firstTitle = 'Start Date',
        $secondTitle = 'End Date',
        $firstModel = 'startAt',
        $secondModel = 'endAt'
    ) {
        $this->firstTitle = $firstTitle;
        $this->secondTitle = $secondTitle;
        $this->firstModel = $firstModel;
        $this->secondModel = $secondModel;
    }

    public function render()
    {
        return view('livewire.utils.form-date-picker');
    }
}
