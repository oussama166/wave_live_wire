<?php
namespace App\Livewire\Utils;

use Livewire\Component;

use function Safe\json_decode;

class Dropdown extends Component
{
    public $select = 'vacationType';
    public $label;
    public $data;

    public function mount(
        $label = 'List of vacations',
        $data = [],
    ) {
        $this->label = $label;
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.utils.dropdown', [
            'data' => $this->data,
        ]);
    }

    public function updatedSelect($value){
        $this->dispatch('updateSelect',$value);
    }



}
