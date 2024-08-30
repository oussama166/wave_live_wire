<?php

namespace App\Livewire\Admin\Settings;

use App\Models\ExperienceLevels as ModelsExperienceLevels;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ExperienceLevels extends Component
{

    protected $listeners = [
        "changeDataExperience" => "changeDataExperience",
        "deleteDataExperience" => "deleteDataExperience",
    ];
    public $experienceLevels;

    public $updateId = -1;
    #[Validate("required|min:3")]
    public string $label = '';
    #[Validate("required|min:3|max:255")]
    public string $description = '';

    #[Title("Experience Levels")]
    public function render()
    {
        $this->getAllExperienceLevels();
        return view('livewire.admin.settings.experience-levels');
    }

    public function getAllExperienceLevels(): void
    {
        $this->experienceLevels = ModelsExperienceLevels::all()->map(function ($fmSt) {
            return [
                "id" => $fmSt->id,
                "label" => $fmSt->label,
                'description' => $fmSt->description,

            ];
        });
    }

    #[On('changeDataExperience')]
    public function changeDataExperience($id): void
    {
        $experienceLevelData = ModelsExperienceLevels::query()->find($id);
        $this->updateId = $id;
        $this->label = $experienceLevelData->label;
        $this->description = $experienceLevelData->description;
    }

    #[On('deleteDataExperience')]
    public function deleteDataExperience($id): void
    {

        $experienceLevelData = ModelsExperienceLevels::query()->find($id);
        $experienceLevelData->delete();
    }

    public function updateContractType(): void
    {
        $this->validate();
        if($this->updateId == -1){

            ModelsExperienceLevels::query()->Create(
                [
                    "label" => $this->label,
                    "description" => $this->description
                ]
            );
            $this->dispatch('toast',
                type:"success",
                title : "Created Successfully",
                text:"New experience level created",
            );
        }else {
            ModelsExperienceLevels::query()->where("id", $this->updateId)->update(
                [
                    "label" => $this->label,
                    "description" => $this->description
                ]
            );
            $this->dispatch('toast',
                type:"success",
                title : "Update Successfully",
                text:"Experience level updated",
            );
        }
        $this->reset();
    }
}
