<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public $email;
    #[Rule(['required', 'email'])]
    public $password;
    #[Rule(['required', 'min:8', 'confirmed'])]
    public $passwordConfirmation;

    public function mount(Request $request, $token)
    {
        $this->token = $token;
        $this->validate();

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function (User $user, string $password) {
                $user
                    ->forceFill([
                        'password' => Hash::make($password),
                    ])
                    ->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()
                ->route('login')
                ->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    #[Title('Reset Password')]
    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
