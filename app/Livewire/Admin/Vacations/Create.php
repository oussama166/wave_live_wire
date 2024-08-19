<?php

namespace App\Livewire\Admin\Vacations;

use App\Models\Leaves;
use App\Models\LeaveStatus;
use App\Models\User;
use App\Models\VacationType;
use App\Notifications\CongeInfo;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    protected $listeners = [
        "setSelectedItem" => "setSelectedItem",
        'datesSelected' => 'handleDatesSelected',
    ];
    public $vacationTypes;
    public $selectArea;
    #[Validate("required")]
    public $selectedValue;
    #[Validate("required")]
    public $description;
    #[Validate("required")]
    public $startAt;
    #[Validate("required")]
    public $endAt;

    #[Title("Create new vacation")]
    public function render()
    {
        $this->getInfo();
        return view('livewire.admin.vacations.create');
    }

    #[On('setSelectedItem')]
    public function setSelectedItem($result): void
    {
        \Log::info("Vacation created", [$result]);
        $this->selectedValue = User::query()->with(["position", "contracts", "experienceLevel"])->find($result);
    }

    public function handleDatesSelected($startAt, $endAt)
    {
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }


    public function getInfo()
    {
        $this->vacationTypes = VacationType::all()->map(function ($vac) {
            return [
                'id' => $vac->id,
                'label' => $vac->label,
            ];
        });
    }

    public function createVacation() {
        // Validate the request data
        $this->validate();

        // Calculate the amount of days for the vacation request
        $amount = detect_holiday(new \DateTime($this->startAt), new \DateTime($this->endAt));

        // Get the user instance
        $user = $this->selectedValue;


        // Check if the user has enough balance
        if ($user->balance >= $amount) {
            try {
                \DB::beginTransaction();

                // Create the vacation request
                $leaveData = [
                    'start_at' => $this->startAt,
                    'end_at' => $this->endAt,
                    'description' => $this->description,
                    'leaves_days' => $amount,
                    'vacation_type_id' => VacationType::query()->where("label", "like", $this->selectArea)->first()->id,
                    'user_id' => (int) $user->id,
                    'leave_status_id' => LeaveStatus::query()->where('label', 'Like', 'Approved')->first()->id,
                ];

                $leave = Leaves::query()->create($leaveData);

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

                    // Notification (Add logging around this)
                    try {
                        $notifyUser = User::query()->find($user->id);
                        Log::info("data info",[$notifyUser]);
                        $notifyUser->notify(new CongeInfo('Vacation request', $leave->getOriginal(), "Approved"));
                        sleep(4);
                    } catch (\Exception $e) {
                        Log::error('Failed to send notification: ' . $e->getMessage());
                    }

                    // Redirect to the user dashboard
                    return redirect()->route('Admin.VacationRequest.List');
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


}
