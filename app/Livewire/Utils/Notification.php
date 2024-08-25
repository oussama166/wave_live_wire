<?php

namespace App\Livewire\Utils;

use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Notification extends Component
{
    public $userId;

    /**
     * Mount the component with the user ID.
     *
     * @param int $userId
     */
    public function mount()
    {
        $this->userId = FacadesAuth::id();
    }

    public function render()
    {
        return view('livewire.utils.notification');
    }

    public function markAsRead($notification)
    {
        $notification->markAsRead();
    }
}
