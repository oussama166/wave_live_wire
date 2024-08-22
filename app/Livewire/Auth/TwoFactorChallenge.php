<?php

namespace App\Livewire\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticationProvider;
use Livewire\Attributes\Title;
use Livewire\Component;
use Mockery\Exception;
use Nette\Schema\ValidationException;

class TwoFactorChallenge extends Component
{
    public $code;
    public $recoveryCode;

    public function authenticate()
    {
        $user = Auth::user();

        try {
            if (!$user) {
                throw new \Exception("User not found");
            }

            // Handle if recovery code is used
            if ($this->recoveryCode) {
                if ($this->validateRecoveryCode($user, $this->recoveryCode)) {
                    $this->dispatch(
                        'alert',
                        type: "success",
                        title: "You are connected",
                        position: "center"
                    );
                    return redirect()->intended($this->redirectPath());
                }

                throw new \Exception('The provided recovery code is invalid.');
            }

            // Handle regular 2FA code
            if ($this->code) {
                if ($this->validateTwoFactorCode($user, $this->code)) {
                    $this->dispatch(
                        'alert',
                        type: "success",
                        title: "You are connected",
                        position: "center"
                    );
                    return redirect()->intended($this->redirectPath());
                }

                throw new \Exception('The provided two-factor authentication code is invalid.');
            }

            throw new \Exception('Please provide a two-factor authentication code or recovery code.');
        } catch (\Exception $e) {
            $this->addError('authentication', $e->getMessage());

            $this->dispatch(
                'alert',
                type: "warn",
                title: $e->getMessage(),
                position: "center"
            );
        }
    }



    protected function validateTwoFactorCode($user, $code)
    {
        return app(TwoFactorAuthenticationProvider::class)->verify(
            decrypt($user->two_factor_secret),
            $code
        );
    }

    protected function validateRecoveryCode($user, $recoveryCode)
    {
        $decryptedCodes = collect(json_decode(decrypt($user->two_factor_recovery_codes), true));

        if ($decryptedCodes->contains($recoveryCode)) {
            // Remove the used recovery code
            $user->replaceRecoveryCode($recoveryCode);

            return true;
        }

        return false;
    }

    protected function redirectPath()
    {
        if (Auth::user()->role === 'admin') {
            return '/admin/dashboard';
        } else {
            return '/user-dashboard';
        }
    }

    #[Title("Two Factor Authentication")]
    public function render()
    {
        return view('livewire.auth.two-factor-challenge');
    }

}
