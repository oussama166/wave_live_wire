<?php
namespace App\Livewire\User\VacationRequest;

use App\Models\VacationType;
use Illuminate\Http\Request as HttpRequest;
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
        // Process the HTTP request here
        dd($request->all());
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

    #[On('updateSelect')]
    public function updateSelect($value)
    {
        $this->vacationType = $value;
        $this->vacationInfo = VacationType::query()
            ->where('label', 'like', '%' . $value . '')
            ->get();
    }
}
