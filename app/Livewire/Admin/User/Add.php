<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\userAdd;
use App\Models\Contracts;
use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Add extends Component
{
    protected $listeners = [
        'handleTimeChange' => 'handleTimeChange',
    ];

    public userAdd $addForm;

    public $selectArea;
    public $getExperienceLevels;
    public $getPositions;
    public $getNationality;
    public $getFamilyStatus;
    public $getRole;
    public $getSex;
    public $getContracts;

    public function mount()
    {
        $this->getInfo();
    }

    #[Title("Add new employer")]
    public function render()
    {
        return view('livewire.admin.user.add');
    }

    // GET INFORAMTION ABOUT USER FROM OTHER TABLES
    public function getInfo(): void
    {
        $this->getExperienceLevels = ExperienceLevels::all()
            ->map(function ($experienceLevel) {
                return [
                    'id' => (string) $experienceLevel->id,
                    'label' => $experienceLevel->label,
                ];
            })
            ->toArray();
        $this->getPositions = Position::all()->map(function ($position) {
            return [
                'id' => (string) $position->id,
                'label' => $position->label,
            ];
        });
        $this->getNationality = Nationality::all()->map(function (
            $nationality
        ) {
            return [
                'id' => (string) $nationality->id,
                'label' => $nationality->label,
            ];
        });
        $this->getFamilyStatus = FamilyStatus::all()->map(function (
            $familyStatus
        ) {
            return [
                'id' => (string) $familyStatus->id,
                'label' => $familyStatus->label,
            ];
        });
        $this->getContracts = Contracts::all()->map(function ($contract) {
            return [
                'id' => (string) $contract->id,
                'label' => $contract->label,
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

    public function addEmployer(): void
    {
        try{
            $this->addForm->createUser();
            $this->dispatch('toast',
            type:'success',
            title:'User created successfully',
            text:'User created successfully'
        );
        } catch (\Exception $e) {
            $this->dispatch('toast',
            type:'succes',
            title:'Error creating user',
            text:$e->getMessage()
        );

        }
    }

    #[On('handleTimeChange')]
    public function handleTimeChange($model, $value): void
    {
        $dataSet = str_replace('addForm.', '', $model);
        $this->addForm->{$dataSet} = $value;
    }
}
