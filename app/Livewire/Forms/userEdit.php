<?php

namespace App\Livewire\Forms;

use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Log;

class userEdit extends Form
{
    public $id;
    #[Validate("required|string|max:255")]
    public $name;
    #[Validate("required|string|max:255")]
    public $lastname;
    #[Validate("required|in:admin,user")]
    public $role;
    #[Validate("required|string|email|max:255|unique:users,email")]
    public $email;
    #[Validate("required|string|max:255|unique:users,cin")]
    public $cin;
    #[Validate("required|string|max:255|unique:users,cnss")]
    public $cnss;
    #[Validate("required|in:male,female")]
    public $sexe;
    #[Validate("required|date")]
    public $birth_date;
    #[Validate("required|date")]
    public $hiring_date;
    #[Validate("required|string")]
    public $phone;
    #[Validate("required|string")]
    public $adresse;
    #[Validate("required|numeric")]
    public $balance;
    public $comment;


    public $previous_balance;

    public $commentOn = false;

    //define variable
    public $getExperienceLevels;
    public $getPosition;
    public $getNationality;
    public $getFamilyStatus;
    public $getContracts;
    public $getRole;
    public $getSex;


    // GET INFORAMTION ABOUT USER FROM OTHER TABLES
    public function getInfo(): void
    {
        $this->getExperienceLevels = ExperienceLevels::all()
            ->map(function ($experienceLevel) {
                return [
                    'id' => (string)$experienceLevel->id, // Ensure ID is a string
                    'label' => $experienceLevel->label, // Adjust according to your attribute
                ];
            })
            ->toArray();
        $this->getPosition = Position::all()->map(function ($position) {
            return [
                'id' => (string)$position->id,
                'label' => $position->label,
            ];
        });
        $this->getNationality = Nationality::all()->map(function (
            $nationality
        ) {
            return [
                'id' => (string)$nationality->id,
                'label' => $nationality->label,
            ];
        });
        $this->getFamilyStatus = FamilyStatus::all()->map(function (
            $familyStatus
        ) {
            return [
                'id' => (string)$familyStatus->id,
                'label' => $familyStatus->label,
            ];
        });
        $this->getRole = [
            ['id' => '0', 'label' => 'admin'],
            ['id' => '1', 'label' => 'user'],
        ];
        $this->getSex = [
            ['id' => '0', 'label' => 'female'],
            ['id' => '1', 'label' => 'male'],
        ];
    }


    // STORE THE DATA OR UPDATE IN THE DATABASE

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
            'email' =>
                'required|string|email|max:255|unique:users,email,' . $this->id,
            'cin' => 'required|string|max:255|unique:users,cin,' . $this->id,
            'cnss' => 'required|string|max:255|unique:users,cnss,' . $this->id,
            'sexe' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'hiring_date' => 'required|date',
            'phone' => 'required|string',
            'adresse' => 'required|string',
            'balance' => 'required|numeric',
            'comment' => ($this->commentOn) ? 'required|string|min:10' : '',
        ]);


    }
}
