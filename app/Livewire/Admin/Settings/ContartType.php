<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Contracts;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContartType extends Component
{

    protected $listeners = [
        "changeDataContract" => "changeDataContract",
        "deleteDataContract" => "deleteDataContract",
    ];
    public $contracts;

    #[Validate("required|min:3")]
    public string $label='';
    #[Validate("required|min:3|max:255")]
    public string $description='';


    #[Title("Contact Types")]
    public function render()
    {
        $this->getAllContractTypes();

        return view('livewire.admin.settings.contart-type');
    }


    public function getAllContractTypes(): void
    {
        $this->contracts = Contracts::all()->map(function ($cnt) {
            return [
                "id" => $cnt->id,
                "label" => $cnt->label,
                'description' => $cnt->description,

            ];
        });
    }

    #[On('changeDataContract')]
    public function changeDataContract($id): void
    {
        $contractData = Contracts::query()->find($id);
        $this->label = $contractData->label;
        $this->description = $contractData->description;
    }
    #[On('deleteDataContract')]
    public function deleteDataContract($id): void
    {

        $contractData = Contracts::query()->find($id);
        $contractData->delete();
    }

    public function updateContractType(): void
    {
        $this->validate();
        Contracts::query()->updateOrCreate(
            [
                "label" => $this->label,
                "description" => $this->description
            ]
        );
        $this->dispatch("toast",
            type:"success",
            title:"Contract Type Updated",
            text:""
        );
        $this->reset();
        redirect()->route("Admin.VacationRequest.Create");
    }
}
