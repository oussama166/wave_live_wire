<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\userEdit;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public userEdit $form;
    public $user;

    #[Validate('required')]
    public $sex;
    #[Validate('required')]
    public $selectArea;
    #[Validate('required')]
    public $role;
    #[Validate('required')]
    public $experience_level;
    #[Validate('required')]
    public $family_status;
    #[Validate('required')]
    public $nationality;


    // private
    public $previous_balance;

    #[Title('Edit User')]
    public function mount($id)
    {
        $this->form->id = $id;
        $this->form->getInfo();

        // Getting the user information
        $this->user = User::query()
            ->with([
                'experienceLevel',
                'familyStatus',
                'nationality',
                'position',
                'contracts',
            ])
            ->find($this->form->id);

        // Update the init information from the user information array
        $this->role = $this->user['role'];
        $this->sex = $this->user['sexe'];

        $this->experience_level = $this->user['experienceLevel']->label;
        $this->family_status = $this->user['familyStatus']->label;
        $this->nationality = $this->user['nationality']->label;

        $this->form->balance = $this->user['balance'];
        $this->form->name = $this->user['name'];
        $this->form->lastname = $this->user['lastname'];
        $this->form->email = $this->user['email'];
        $this->form->cin = $this->user['cin'];
        $this->form->cnss = $this->user['cnss'];
        $this->form->phone = $this->user['phone'];
        $this->form->adresse = $this->user['adresse'];
        $this->form->birth_date = $this->user['birth_date'];
        $this->form->hiring_date = $this->user['hiring_date'];

        $this->form->previous_balance = $this->user['balance'];
    }

    public function render()
    {
        return view('livewire.admin.user.edit');
    }


    public function changeBasicInformation()
    {
        $this->form->save();
    }

    public function updated($props, $value):void
    {

        if($props == "form.balance"){
            $this->form->balance = $value;
            $this->form->commentOn = $this->form->balance != $this->previous_balance;
        }

    }
    public function updatedRole($value)
    {
        $this->role = $value;
    }


}
