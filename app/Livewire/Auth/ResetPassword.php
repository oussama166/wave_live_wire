<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;

    #[Validate(['required', 'email', 'max:255'])]
    public $email;

    #[Validate(['required', 'min:8'])]
    public $password;

    #[Validate(['required', 'min:8', 'same:password'])]
    public $password_confirmation;


    public function mount(Request $request, $token)
    {
        $this->token = $token;
        $this->email = $request->email;

        $this->password = '';
        $this->password_confirmation = '';
    }

    public function resetPassword(Request $request)
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'token' => $this->token,
        ];
        $status = Password::reset($credentials, function (
            User $user,
            string $password
        ) {
            $user
                ->forceFill([
                    'password' => Hash::make($password),
                ])
                ->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });


        if ($status === Password::PASSWORD_RESET) {
            $this->dispatch('alert',
                type :'success',
                title : 'Password Reset Successful',
                text :
                    'Your password has been successfully reset. You can now log in with your new password.',
            );
            return $this->redirectRoute('Auth.Login', navigate: true);
        } else {
            $this->dispatch('alert',
                type :'warning',
                title : 'Failed to Reset Password',
                text :
                    'We were unable to reset your password. Please try again.',
            );
            return back()->withErrors(['email' => [__($status)]]);
        }
    }


    public function checkPassword(){
        return $this->password === $this->password_confirmation;
    }


    #[Title('Reset Password')]
    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
