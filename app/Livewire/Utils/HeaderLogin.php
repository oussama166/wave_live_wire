<?php

namespace App\Livewire\Utils;

use App\Models\User;
use Auth;
use Livewire\Component;

class HeaderLogin extends Component
{
    // init component properties
    public $name = 'User';
    public $balance = 0;
    public $path = '/';
    public $title = 'Dashboard';

     // A property to track if GSAP has been initialized
     protected $gsapInitialized = false;
    // mount method
    public function mount($name, $balance, $path, $title)
    {
        $this->name = $name;
        $this->balance = $balance;
        $this->path = $path;
        $this->title = $title;
    }

    // render method
    public function render()
    {
        // Here, we check if GSAP has been initialized
        if (!$this->gsapInitialized) {
            $this->dispatch('initialize-gsap');
            $this->gsapInitialized = true;
        }
        return view('livewire.utils.header-login');
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();


        $this->dispatch('toast', type : 'success', message : 'Logout successfully!');
        $this->redirect('/');


    }
    public function updateBalance()
    {
        if (Auth::check()) {
            $this->balance = User::find(Auth::id())->balance;
        } else {
            $this->balance = 0; // or handle it differently based on your needs
        }
    }
}
