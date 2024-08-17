<?php

namespace App\Livewire\Forms;

use App\Models\Audit;
use App\Models\AuditAdmin;
use App\Models\ExceptionlLeaveBalance;
use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Validate;
use Livewire\Form;

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
    #[Validate('required')]
    public $selectArea;
    #[Validate('required')]
    public $experience_level;
    #[Validate('required')]
    public $family_status;
    #[Validate('required')]
    public $nationality;
    public $comment;


    public $previous_balance;

    public $commentOn = false;




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
            'experience_level' => 'required',
            'family_status' => 'required',
            'nationality' => 'required',
        ]);

        try {
            // Fetch the original user data
            $user = User::find($this->id);
            $originalValues = $user->getOriginal(); // Original values before update

            // Update user data
            User::where("id", $this->id)->update([
                'name' => $this->name,
                'lastname' => $this->lastname,
                'role' => $this->role,
                'email' => $this->email,
                'cin' => $this->cin,
                'cnss' => $this->cnss,
                'sexe' => $this->sexe,
                'birth_date' => $this->birth_date,
                'hiring_date' => $this->hiring_date,
                'phone' => $this->phone,
                'adresse' => $this->adresse,
                'balance' => $this->balance,
                'experience_level_id' => ExperienceLevels::where('label', 'Like', $this->experience_level)->first()->id,
                'family_status_id' => FamilyStatus::where('label', 'Like', $this->family_status)->first()->id,
                'nationality_id' => Nationality::where('label', 'Like', $this->nationality)->first()->id,
            ]);

            // Fetch the updated user data
            $updatedUser = User::find($this->id);
            $newValues = $updatedUser->getAttributes(); // New values after update

            // Log the original user data
            Log::info("Data", [
                "data json" => json_encode($originalValues),
            ]);


            // Create ExceptionalLeaveBalance record if needed
            if ($this->commentOn) {
                ExceptionlLeaveBalance::query()->create([
                    "user_id" => $this->id,
                    "admin_id" => Auth::id(),
                    "days_added" => $this->balance - $this->previous_balance,
                    "raison" => $this->comment
                ]);
            }

            // Create audit record
            $audit = Audit::query()->create(
                [
                    "audit_event" => "Update",
                    "audit_target"=>"basic info",
                    "audit_url" => Request::url(),
                    "audit_model_affected"=> "\App\Models\User",
                    "audit_details" => Auth::user()->name . " " . Auth::user()->lastname . " info updated from admin panel",
                ]
            );


            // Create audit admin record
            AuditAdmin::query()->create([
                "audit_id" => $audit->id,
                "user_id" => $this->id,
                "admin_id" => Auth::id(),
                "old_values" => json_encode($originalValues),
                "new_values" => json_encode($newValues),
            ]);

        } catch (\Exception $exception) {
            Log::error('Error occurred: ' . $exception->getMessage(), [
                'exception' => $exception
            ]);
        }

    }
}
