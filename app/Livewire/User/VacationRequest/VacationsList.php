<?php

namespace App\Livewire\User\VacationRequest;

use App\Models\Leaves;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class VacationsList extends Component
{
    #[Title("Vacation Request List")]
    public function render()
    {
        return view('livewire.user.vacation-request.vacations-list');
    }
}
