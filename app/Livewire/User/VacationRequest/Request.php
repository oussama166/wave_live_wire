<?php

namespace App\Livewire\User\VacationRequest;

use App\Models\LeaveStatus;
use App\Models\VacationType;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Request extends Component
{
    protected $listeners = [
        'datesSelected' => 'handleDatesSelected',
        'updateSelect' => 'updateSelect',
    ];

    #[Validate('required')]
    public $vacationType;
    #[Validate('required')]
    public $startAt;
    #[Validate('required')]
    public $endAt;
    #[Validate('required')]
    public $description = '';

    public $vacationInfo = null;


    public function createVacationRequest(HttpRequest $request)
    {
        // validate the start ,end ,type and description

        // Check if he has the enough balance


        dd($request->all());
    }


    public function mount()
    {
        $this->vacationTypes = VacationType::all();
    }

    #[Title('Vacation Request')]
    public function render()
    {
        $getVacationTypes = VacationType::select('id', 'label')->get();
        return view('livewire.user.vacation-request.request', [
            'vacationTypes' => $getVacationTypes,
        ]);
    }

    public function handleDatesSelected($startAt, $endAt)
    {
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    public function updatedVacationType($value)
    {
        $this->vacationInfo = VacationType::query()->where('label', $value)->first()->getOriginal();

        /*  Expect data

              "id" => 6
              "label" => "Congé Sans Solde"
              "description" => "Congé pris sans rémunération."
              "isPaid" => 0
              "duration" => 0
              "reduction" => 100
              "backgroundColor" => "#9E9E9E"
          */
    }


}
