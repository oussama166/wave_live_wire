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
        // Attempt to authenticate the user with the provided credentials
        if (auth()->attempt($credentials))
        {
            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            // Check if two-factor authentication is enabled and required
            if (Features::enabled(Features::twoFactorAuthentication()) &&
                Auth::user()->two_factor_secret) {
                // Handle the 2FA process
                return redirect()->route('two-factor.login');
            }

            $this->dispatch
            ('alert',
            type:"success",
            title : "Your are connected",
            position:"center"
            );

            if (Auth::user()->role === 'admin') {
                return $this->redirect("/admin/dashboard");
            } else {
                return $this->redirect("/user-dashboard");
            }
        }

        $this->dispatch('alert',
        type:"warning",
        title : "Impossible to connect",
        text : "Your email or password is incorrect",
        position:"center"
    );
        // Redirect back with an error message
        return back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ]);
    }

    #[Title('Login')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
