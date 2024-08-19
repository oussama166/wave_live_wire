<?php

namespace App\Livewire\Admin\Vacations;

use Livewire\Attributes\Title;
use Livewire\Component;

class VacationList extends Component
{
    #[Title("Vacation Request List")]
    public function render()
    {
        return view('livewire.admin.vacations.vacation-list');
    }
}
