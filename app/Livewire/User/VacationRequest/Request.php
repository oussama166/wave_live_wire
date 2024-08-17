<?php

namespace App\Livewire\User\VacationRequest;

use App\Models\Leaves;
use App\Models\LeaveStatus;
use App\Models\VacationType;
use App\Notifications\CongeInfo;
use DateTime;
use Illuminate\Support\Facades\Log;
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
    public $selectArea;
    #[Validate('required', message: "Start at is require filed")]
    public $startAt;
    #[Validate('required', message: "End at is require filed")]
    public $endAt;
    #[Validate('required|min:10', message: "Description at is require filed")]
    public $description = '';

    public $vacationTypes;

    public $vacationInfo = null;


    public function createVacationRequest()
    {
        // Validate the request data
        $this->validate();

        // Calculate the amount of days for the vacation request
        $amount = detect_holiday(new DateTime($this->startAt), new DateTime($this->endAt));

        // Get the user instance
        $user = auth()->user();

        // Check if the user has enough balance
        if ($user->balance >= $amount) {
            try {
                \DB::beginTransaction();

                // Create the vacation request
                $leave = Leaves::query()->create([
                    'start_at' => $this->startAt,
                    'end_at' => $this->endAt,
                    'description' => $this->description,
                    'vacation_type_id' => $this->vacationInfo["id"],
                    'user_id' => $user->id,
                    'leave_status_id' => LeaveStatus::query()->where('label','Like','Pending')->first()->id,
                ]);

                if ($leave) {
                    // Update the user's balance
                    $user->update([
                        'balance' => \DB::raw('balance - ' . $amount)
                    ]);

                    // Commit the transaction
                    \DB::commit();

                    // Dispatch success alert
                    $this->dispatch('alert',
                        type: 'success',
                        title: 'Vacation Time',
                        text: 'Your vacation request has been created successfully',
                        confirmSet: true,
                        timer: 3500
                    );
                    $user->notify(new CongeInfo('Vacation request',$leave->getOriginal()));
                    // Redirect to the user dashboard
                    // $this->redirectRoute('User.Dashboard', navigate: true);
                    redirect()->route('User.Dashboard');



                } else {
                    throw new \Exception('Failed to create vacation request.');
                }
            } catch (\Exception $exception) {
                // Rollback the transaction if something goes wrong
                \DB::rollBack();

                // Log error and dispatch error alert
                Log::error('Failed to create vacation request: ' . $exception->getMessage());
                $this->dispatch('alert',
                    type: 'error',
                    title: 'Vacation Time',
                    text: 'Something went wrong while creating your vacation request',
                    confirm: true,
                    confirmSet: false
                );
            }
        } else {
            // Dispatch error alert if balance is insufficient
            $this->dispatch('alert',
                type: 'error',
                title: 'Vacation Time',
                text: 'The requested time off exceeds your available balance.',
                confirm: true,
                confirmSet: false,
                timer: 3500
            );
        }
    }


    public function mount()
    {

        $this->vacationTypes = VacationType::all()->map(function($vacationType) {
            return [
                'id' => (string) $vacationType->id, // Ensure ID is a string
                'label' => $vacationType->label,    // Adjust according to your attribute
            ];
        })->toArray();
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

    public function updatedSelectArea($value)
    {
        $this->vacationInfo = VacationType::query()->where('label', $value)->first()->getOriginal();
    }


}
