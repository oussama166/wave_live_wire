<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class ForgotPassword extends Component
{
    #[Rule('required|email')]
    public $email;

    public function resetPassword()
    {
        $this->validate();

        // Send password reset link
        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->dispatch('alert',
                type : 'success',
                title : 'Password Reset Link Sent',
                text :
                    'We have sent you a password reset link to your email address.',
            );
            return back()->with(['status' => __($status)]);
        } else {
            $this->dispatch('alert',
            type : 'warning',
                title : 'Failed to Send Password Reset Link',
                text :
                    'We were unable to send the password reset link.',
        );
            return back()->withErrors(['email' => __($status)]);
        }
    }

    #[Title('Forgot Password')]
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
