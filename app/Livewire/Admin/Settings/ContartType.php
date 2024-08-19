<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Contracts;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ContartType extends Component
{

    protected $listeners = [
        "changeData" => "changeData",
    ];
    public $contracts;

    public string $label='';
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

    #[On('changeData')]
    public function changeData($id): void
    {
        $contractData = Contracts::query()->find($id);
        $this->label = $contractData->label;
        Log::info("Description", [$contractData->description]);
        $this->description = $contractData->description;
    }

    public function updateContractType(): void
    {
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
