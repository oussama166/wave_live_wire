<?php

namespace App\Livewire\User\VacationRequest;

use App\Models\Leaves;
use App\Models\LeaveStatus;
use App\Models\User;
use App\Models\VacationType;
use DateTime;
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

    #[Validate('required', message: "Vacation Type is require filed")]
    public $vacationType;
    #[Validate('required', message: "Start at is require filed")]
    public $startAt;
    #[Validate('required', message: "End at is require filed")]
    public $endAt;
    #[Validate('required|min:10', message: "Description at is require filed")]
    public $description = '';

    public $vacationTypes;

    public $vacationInfo = null;


    public function createVacationRequest(HttpRequest $request)
    {
        // Validate the request data
        $this->validate();

        // Calculate the amount of days for the vacation request
        $amount = detect_holiday(new DateTime($request->startAt), new DateTime($request->endAt));

        $user = auth()->user();

        if ($user->balance >= $amount) {
            // Dispatch info alert
            $this->dispatch('alert',
                type: 'info',
                title: 'Vacation Time',
                text: 'The time you will spend is ' . $amount . ' days off the holiday and weekend',
                confirm: true,
                confirmSet:false,
            );

            try {


                // Create the vacation request
                Leaves::query()->create([
                    'start_at' => $this->startAt,
                    'end_at' => $this->endAt,
                    'description' => $this->description,
                    'vacation_type_id' => $this->vacationInfo["id"],
                    'user_id' => auth()->user()->id,
                    'leave_status_id' => 1
                ]);

                // Update the user's balance
                auth()->user()->update([
                    'balance' => \DB::raw('balance - ' . $amount)
                ]);

                // Dispatch success alert
                $this->dispatch('alert',
                    type: 'success',
                    title: 'Vacation Time',
                    text: 'Your vacation request has been created successfully',
                    confirmSet:true,
                    timer:3500

                );

                // Redirect to the user dashboard
                $this->redirect(route('User.Dashboard'), navigate: true);

            } catch (\Exception $exception) {
                // Log error and dispatch error alert
                Log::error('Failed to create vacation request: ' . $exception->getMessage());
                $this->dispatch('alert',
                    type: 'error',
                    title: 'Vacation Time',
                    text: 'Something went wrong while creating your vacation request',
                    confirm:true,
                    confirmSet:false
                );
            }
        } else {
            // Dispatch error alert if balance is insufficient
            $this->dispatch('alert',
                type: 'error',
                title: 'Vacation Time',
                text: 'The requested time off exceeds your available balance.',
                confirm: true,
                confirmSet:false,
                timer: 3500
            );
        }
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
        $this->vacationInfo = $this->vacationTypes->where('label', $value)->first()->getOriginal();

    }


}
