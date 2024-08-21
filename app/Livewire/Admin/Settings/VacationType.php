<?php

namespace App\Livewire\Admin\Settings;

use App\Models\VacationType as ModelsVacationType;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class VacationType extends Component
{
    protected $listeners = [
        "changeData" => "changeData",
        "deleteData" => "deleteData",
    ];
    public $vacationTypes;

    public $updateId = -1;
    #[Validate("required|min:3")]
    public string $label = '';
    #[Validate("required|min:3|max:255")]
    public string $description = '';
    #[Validate("required|boolean")]
    public bool $isPaid = false;
    #[Validate("required|numeric")]
    public int $duration = 1;
    #[Validate("required|numeric")]
    public float $reduction = 0;
    #[Validate("required|string")]
    public string $color = "";


    #[Title('Vacation Type')]
    public function render()
    {
        $this->getAllVacationType();
        return view('livewire.admin.settings.vacation-type');
    }


    public function getAllVacationType(): void
    {
        $this->vacationTypes = ModelsVacationType::all()->map(function ($vacationType) {
            return [
                "id" => $vacationType->id,
                "label" => $vacationType->label,
                "bgColor" => $vacationType->backgroundColor,

            ];
        });
    }

    #[On('changeData')]
    public function changeData($id): void
    {
        $vacationTypeData = ModelsVacationType::query()->find($id);
        $this->updateId = $id;
        $this->label = $vacationTypeData->label;
        $this->description = $vacationTypeData->description;
        $this->isPaid = $vacationTypeData->isPaid;
        $this->duration = $vacationTypeData->duration;
        $this->reduction = $vacationTypeData->reduction;
        $this->color = $vacationTypeData->backgroundColor;
    }

    #[On('deleteData')]
    public function deleteData($id): void
    {

        $vacationTypeData = ModelsVacationType::query()->find($id);
        $vacationTypeData->delete();
    }

    public function updateContractType(): void
    {
        $this->validate();
        if ($this->updateId == -1) {

            ModelsVacationType::query()->Create(
                [
                    "label" => $this->label,
                    "description" => $this->description,
                    "isPaid" => $this->isPaid,
                    "backgroundColor" => $this->color,
                    "duration" => $this->duration,
                    "reduction" => $this->reduction,

                ]
            );
            $this->dispatch('toast',
                type: "success",
                title: "Created Successfully",
                text: "Vacation type created",
            );
        } else {
            ModelsVacationType::query()->where("id", $this->updateId)->update(
                [
                    "label" => $this->label,
                    "description" => $this->description,
                    "isPaid"=>$this->isPaid,
                    "duration" => $this->duration,
                    "reduction" => $this->reduction,
                    "backgroundColor" => $this->color,
                ]
            );
            $this->dispatch('toast',
                type: "success",
                title: "Update Successfully",
                text: "Vacation Type updated",
            );
        }
        $this->reset();
    }
}




