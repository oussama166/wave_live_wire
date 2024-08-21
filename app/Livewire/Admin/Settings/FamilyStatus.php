<?php

namespace App\Livewire\Admin\Settings;


use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use \App\Models\FamilyStatus as ModelsFamilyStatus;

class FamilyStatus extends Component
{

    protected $listeners = [
        "changeData" => "changeData",
        "deleteData" => "deleteData",
    ];
    public $familyStatus;

    public $updateId = -1;
    #[Validate("required|min:3")]
    public string $label = '';
    #[Validate("required|min:3|max:255")]
    public string $description = '';

    #[Title("Family Status")]
    public function render()
    {
        $this->getAllFamilyStatusType();
        return view('livewire.admin.settings.family-status');
    }

    public function getAllFamilyStatusType(): void
    {
        $this->familyStatus = ModelsFamilyStatus::all()->map(function ($fmSt) {
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
        $familyStatusData = ModelsFamilyStatus::query()->find($id);
        $this->updateId = $id;
        $this->label = $familyStatusData->label;
        $this->description = $familyStatusData->description;
    }

    #[On('deleteData')]
    public function deleteData($id): void
    {

        $familyStatusData = ModelsFamilyStatus::query()->find($id);
        $familyStatusData->delete();
    }

    public function updateContractType(): void
    {
        $this->validate();
        if($this->updateId == -1){

        ModelsFamilyStatus::query()->Create(
            [
                "label" => $this->label,
                "description" => $this->description
            ]
        );
            $this->dispatch('toast',
                type:"success",
                title : "Created Successfully",
                text:"New family status created",
            );
        }else {
            ModelsFamilyStatus::query()->where("id", $this->updateId)->update(
                [
                    "label" => $this->label,
                    "description" => $this->description
                ]
            );
            $this->dispatch('toast',
                type:"success",
                title : "Update Successfully",
                text:"family status updated",
            );
        }
        $this->reset();
    }
}
