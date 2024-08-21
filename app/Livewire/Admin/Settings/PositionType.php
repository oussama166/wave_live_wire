<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Position as ModelsPositionTypes;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PositionType extends Component
{

    protected $listeners = [
        "changeData" => "changeData",
        "deleteData" => "deleteData",
    ];
    public $positionsTypes;

    public $updateId = -1;
    #[Validate("required|min:3")]
    public string $label = '';
    #[Validate("required|min:3|max:255")]
    public string $description = '';

    #[Title("Positions Types")]
    public function render()
    {
        $this->getAllPositionTypes();
        return view('livewire.admin.settings.position-type');
    }

    public function getAllPositionTypes(): void
    {
        $this->positionsTypes = ModelsPositionTypes::all()->map(function ($fmSt) {
            return [
                "id" => $fmSt->id,
                "label" => $fmSt->label,
                'description' => $fmSt->description,

            ];
        });
    }

    #[On('changeData')]
    public function changeData($id): void
    {
        $experienceLevelData = ModelsPositionTypes::query()->find($id);
        $this->updateId = $id;
        $this->label = $experienceLevelData->label;
        $this->description = $experienceLevelData->description;
    }

    #[On('deleteData')]
    public function deleteData($id): void
    {

        $experienceLevelData = ModelsPositionTypes::query()->find($id);
        $experienceLevelData->delete();
    }

    public function updateContractType(): void
    {
        $this->validate();
        if ($this->updateId == -1) {

            ModelsPositionTypes::query()->Create(
                [
                    "label" => $this->label,
                    "description" => $this->description
                ]
            );
            $this->dispatch('toast',
                type: "success",
                title: "Created Successfully",
                text: "New position type created",
            );
        } else {
            ModelsPositionTypes::query()->where("id", $this->updateId)->update(
                [
                    "label" => $this->label,
                    "description" => $this->description
                ]
            );
            $this->dispatch('toast',
                type: "success",
                title: "Update Successfully",
                text: "Position type updated",
            );
        }
        $this->reset();
    }
}


