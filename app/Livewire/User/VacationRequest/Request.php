<?php

namespace App\Livewire\User\VacationRequest;

use Livewire\Attributes\Title;
use Livewire\Component;

class Request extends Component
{
    #[Title('Vacation Request')]
    public function render()
    {
        return view('livewire.user.vacation-request.request');
    }
}
