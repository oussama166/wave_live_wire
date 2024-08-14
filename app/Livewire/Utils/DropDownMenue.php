<?php

namespace App\Livewire\Utils;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DropDownMenue extends Component
{
    public $title = 'action';
    public $customStyleButton = '';
    public $keyValue;

    public function mount(
        $title = 'action',
        $customStyleButton = '',
        $keyValue = ''
    ) {
        $this->title = $title;
        $this->customStyleButton = $customStyleButton;
        $this->keyValue = $keyValue;
    }

    public function render()
    {
        return view('livewire.utils.drop-down-menue');
    }

    public function edit($id)
    {
        $this->redirect(route('Admin.edit', ['id' => $id]));
    }
}
