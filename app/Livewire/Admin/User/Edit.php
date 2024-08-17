<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\editSalary;
use App\Livewire\Forms\userEdit;
use App\Models\AuditAdmin;
use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Edit extends Component
{

    protected $listeners = [
        'handleTimeChange' => 'handleTimeChange',
    ];

    public $user;

    public userEdit $form;
    public editSalary $formSalary;
    public position $formPosition;


    //define variable
    public $getExperienceLevels;
    public $getPosition;
    public $getNationality;
    public $getFamilyStatus;
    public $getRole;
    public $getSex;
    public $getContracts;



    #[Title('Edit User')]
    public function mount($id): void
    {
        $this->form->id = $id;
        $this->getInfo();

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
        $this->form->role = $this->user['role'];
        $this->form->sexe = $this->user['sexe'];

        $this->form->experience_level = $this->user['experienceLevel']->label;
        $this->form->family_status = $this->user['familyStatus']->label;
        $this->form->nationality = $this->user['nationality']->label;

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


    public function changeBasicInformation(): void
    {
        try {
            $this->form->save();
            $this->dispatch(
                "toast",
                type: "success",
                title: "User information was successfully changed"
            );
            $this->redirect(route('Admin.edit', $this->form->id));
        } catch (\Exception $e) {
            $this->dispatch(
                "toast",
                type: "warning",
                title: $e->getMessage()
            );
        }

    }


    public function changeSalaryInformation(): void
    {
        echo "hey";
    }

    public function updated($props, $value): void
    {

        if ($props == "form.balance") {
            $this->form->balance = $value;
            $this->form->commentOn = $this->form->balance != $this->form->previous_balance;
        }

    }



    // GET INFORAMTION ABOUT USER FROM OTHER TABLES
    public function getInfo(): void{
        $this->getExperienceLevels = ExperienceLevels::all()
            ->map(function ($experienceLevel) {
                return [
                    'id' => (string)$experienceLevel->id,
                    'label' => $experienceLevel->label,
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

    #[On('handleTimeChange')]
    public function handleTimeChange($model, $value): void
    {
        // Check if the model contains "form"
        if (Str::contains($model, 'form.')) {
            $dataSet = str_replace('form.', '', $model);
            $this->form->{$dataSet} = $value;
        } elseif (Str::contains($model, 'formSalary.')) {
            $dataSet = str_replace('formSalary.', '', $model);
            $this->formSalary->{$dataSet} = $value;
        } elseif (Str::contains($model, 'formPosition.')) {
            $dataSet = str_replace('formPosition.', '', $model);
            $this->formPosition->{$dataSet} = $value;
        }

    }


}
