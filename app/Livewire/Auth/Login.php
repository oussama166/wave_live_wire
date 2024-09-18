<?php

namespace App\Livewire\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required', 'email', 'max:255', 'unique:users,email')]
    public string $email;
    #[Validate('required', 'min:8', 'max:255')]
    public string $password;

    public function connect(Request $request)
    {
        $this->validate();
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];
        //
        // Attempt to authenticate the user with the provided credentials
        if (auth()->attempt($credentials)) {
            // Check if the user account is disabled
            if (Auth::user()->enable_status === 0) {
                $this->dispatch('alert',
                    type : 'warning',
                    title : 'Impossible to connect',
                    text : 'Your account is disabled',
                    position : 'center',
                );
                return;
            }

            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            // Check if two-factor authentication is enabled and required
            if (
                Features::enabled(Features::twoFactorAuthentication()) &&
                Auth::user()->two_factor_secret
            ) {
                return redirect()->route('two-factor.login');
            }

            // Dispatch success alert for successful login
            $this->dispatch('alert',
                type : 'success',
                title : 'You are connected',
                position : 'center',
            );

            // Redirect based on user role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user-dashboard');
            }
        } else {
            // Handle authentication failure
            $this->dispatch('alert',
                type : 'warning',
                title : 'Impossible to connect',
                text : 'Your email or password is incorrect',
                position : 'center',
            );
        }
    }

    #[Title('Login')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
