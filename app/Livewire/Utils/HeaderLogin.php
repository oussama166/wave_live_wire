<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class HeaderLogin extends Component
{
    // init component properties
    public $name = 'User';
    public $balance = 0;
    public $path = '/';
    public $title = 'Dashboard';

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
        return view('livewire.utils.header-login');
    }


    public function logout()
    {
        // logout logic
        auth()->logout();
        $this->dispatch('toast', type : 'success', message : 'Logout successfully!');
        return $this->redirect("/");
    }
}
