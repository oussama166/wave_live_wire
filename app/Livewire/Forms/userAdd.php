<?php

namespace App\Livewire\Forms;

use App\Models\Contracts;
use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use App\Models\User;
use App\Notifications\UserCreated;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class userAdd extends Form
{
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
    #[Validate('required')]
    public $nationality;
    #[Validate('required')]
    public $contract;
    // #[Validate('')]
    // public $password;

    public $selectArea;
    #[Validate('required')]
    public $experience_level;
    #[Validate('required')]
    public $family_status;
    #[Validate('required')]
    public $position;


    public function createUser()
    {
        $this->validate();
        Log::info('User created', $this->toArray());
        // save in database
        try{
            $user = new User();
            $user->name = $this->name;
            $user->lastname = $this->lastname;
            $user->role = $this->role;
            $user->email = $this->email;
            $user->cin = $this->cin;
            $user->cnss = $this->cnss;
            $user->sexe = $this->sexe;
            $user->birth_date = $this->birth_date;
            $user->hiring_date = $this->hiring_date;
            $user->phone = $this->phone;
            $user->adresse = $this->adresse;
            $user->balance = $this->balance;
            $user->nationality_id = Nationality::query()->where("label","like",$this->nationality)->get()->first()->id;
            $user->experience_level_id = ExperienceLevels::query()->where("label","like",$this->experience_level)->get()->first()->id;
            $user->family_status_id = FamilyStatus::query()->where("label","like",$this->family_status)->get()->first()->id;
            $user->position_id = Position::query()->where("label","like",$this->position)->get()->first()->id;
            $user->contract_id = Contracts::query()->where("label","like",$this->contract)->get()->first()->id;
            $user->password = "password12345";
            $user->save();
            $this->reset();
            $user->notify(new UserCreated($user));
        }catch(\Exception $e){
            Log::error('Error creating user', $e->getMessage());
        }
    }







}
