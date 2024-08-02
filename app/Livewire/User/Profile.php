<?php

namespace App\Livewire\User;

use App\Models\Contracts;
use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Profile extends Component
{
    private $user;
    // define model
    #[Validate('required|string|max:255')]
    public $name = '';
    #[Validate('required|string|max:255')]
    public $lastname = '';

    //define variable
    public $getExperienceLevels;
    public $getPosition;
    public $getNationality;
    public $getFamilyStatus;
    public $getContracts;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->lastname = auth()->user()->lastname;
    }

    #[Title('Profile')]
    public function render()
    {
        $this->getInfo();
        return view('livewire.user.profile');
    }

    // UPDATE PROFILE INFORMATION

    public function updateProfile()
    {
        // first we need to validate the name and lastname
        $this->validate();

        // Then we need to get the data for the user
        $this->user = User::find(auth()->user()->id);

        // Then we need to update the user information
        $this->user->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
        ]);

        // Then we need to show the message to the user
        $this->dispatch('toast',
            type : 'success',
            message : 'Profile Updated'
        );

        $this->redirect(route('User.Profile'));
    }

    // GET INFORAMTION ABOUT USER FROM OTHER TABLES
    private function getInfo()
    {
        $this->getExperienceLevels = ExperienceLevels::query()->find(
            auth()->user()->experience_level_id,
            'label'
        )->label;
        $this->getPosition = Position::query()->find(
            auth()->user()->position_id,
            'label'
        )->label;
        $this->getNationality = Nationality::query()->find(
            auth()->user()->nationality_id,
            'label'
        )->label;
        $this->getFamilyStatus = FamilyStatus::query()->find(
            auth()->user()->family_status_id,
            'label'
        )->label;
        $this->getContracts = Contracts::query()->find(
            auth()->user()->contract_id,
            'label'
        )->label;
    }
}
