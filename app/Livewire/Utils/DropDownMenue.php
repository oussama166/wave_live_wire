<?php

namespace App\Livewire\Utils;

use App\Models\User;
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
    )
    {
        $this->title = $title;
        $this->customStyleButton = $customStyleButton;
        $this->keyValue = $keyValue;
    }

    public function render()
    {
        return view('livewire.utils.drop-down-menue');
    }

    public function edit($id):void
    {
        $this->redirect(route('Admin.edit', ['id' => $id]));
    }

    public function enable($id):void
    {
        // I need to get the user
        $user = User::query()->whereId($id)->first();
        // Check if the user already  has access to platform
        $isEnable = $user->enable_status;
        if (!$isEnable) {
            // Turn to disable account
            $user->update(['enable_status' => 1]);
            $this->dispatch(
                'toast',
                type: 'success',
                title: 'Enable user status',
                text: 'Update the user status'
            );
        } else {
            $this->dispatch(
                'toast',
                type: 'warning',
                title: 'Already enable user',
            );
        }
    }

    public function disable($id):void
    {
        // I need to get the user
        $user = User::query()->whereId($id)->first();
        // Check if the user already  has access to platform
        $isEnable = $user->enable_status;
        if ($isEnable) {
            // Turn to disable account
            $user->update(['enable_status' => 0]);
            $this->dispatch(
                'toast',
                type: 'success',
                title: 'Disable user status',
                text: 'Update the user status'
            );
        }else {
            $this->dispatch(
                'toast',
                type: 'warning',
                title: 'Already disabled user',
            );
        }
    }

    public function regeneratePassword($id):void
    {
        $user = User::query()->whereId($id)->first();

        $user->update(['password' => 'password123456']);

        $this->dispatch(
            'toast',
            type: 'success',
            title: 'Regenerate password',
            text: 'The password has been reset to password123456'
        );

    }
}
