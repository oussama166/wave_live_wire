<?php

namespace App\Livewire\User;

use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class Settings extends Component
{


    #[Validate('required|bool')]
    public $TwoOtp = true;

    #[Validate("required")]
    public $oldPassword;

    #[Validate("required|string|min:8|max:255|different:oldPassword")]
    public $newPassword;
    #[Validate("required|string|min:8|max:255|same:newPassword|different:oldPassword")]
    public $confirmPassword;

    public $isCurrentPasswordValid = false;

    public $isValid = false;

    public $isTwoOtpSet = false;


    public function mount(){
        $this->TwoOtp = \auth()->user()->two_factor_secret;
    }
    //  This for the reload and check all the field
    public function updating($props): void
    {
        $this->validateOnly($props);
    }

    public function updated($props,$value): void
    {
        Log::error("log",[
            "props"=>$props,
            "value"=>$value
        ]);
        $this->isValid = $this->isUpdateButtonVisible();
    }

    public function updatedOldPassword($value): void
    {
        // Validate the current password
        $this->isCurrentPasswordValid = $this->validateCurrentPassword($value);

        if (!$this->isCurrentPasswordValid) {
            $this->addError('oldPassword', 'The current password is incorrect.');
        } else {
            $this->resetErrorBag('oldPassword');
        }
        $this->isValid = $this->isUpdateButtonVisible();

    }
    public function updatedTwoOtp($value): void
    {
        $this->isTwoOtpSet = !$this->isTwoOtpSet;
    }


    #[Title('Settings')]
    public function render()
    {

        return view('livewire.user.settings');
    }


    public function isUpdateButtonVisible(): bool
    {
        return $this->validateOnly('newPassword') &&
            $this->validateOnly('confirmPassword') &&
            $this->isCurrentPasswordValid;
    }

    private function validateCurrentPassword($password): bool
    {

        return Hash::check($password, Auth::user()->getAuthPassword());

    }

    public function updatePassword()
    {
        // Validate all fields
        $this->validate();


        // Update the user's password
        try {
            $user = Auth::user();
            $user->password = $this->newPassword;
            $user->save();

            // Provide feedback to the user
            $this->dispatch('toast',
                type: 'success',
                title: 'Password changed.',
                text: 'logout to check if the password is changed.',
                timer: 3500
            );

            // Reset form fields
            $this->reset(['oldPassword', 'newPassword', 'confirmPassword']);
            $this->isCurrentPasswordValid = false;
            $this->isValid = false;

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            // Provide feedback to the user
            $this->dispatch('toast',
                type: 'error',
                title: 'Password not changed.',
                text: 'retry after some time.',
                timer: 3500
            );
        }
    }
}
