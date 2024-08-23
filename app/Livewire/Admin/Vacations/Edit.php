<?php

namespace App\Livewire\Admin\Vacations;

use App\Models\Leaves;
use App\Models\LeaveStatus;
use App\Models\User;
use App\Notifications\CongeInfo;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{


    #[Validate("required")]
    public int $id;
    public Leaves $leaves;
    public User $user;


    public string|null $status;
    public bool $commentOn = false;
    public string $comment = '';
    public mixed $getStatus;
    public mixed $selectArea;

    public function mount($id): void
    {
        $this->id = $id;
        $this->leaves = Leaves::query()->with(["user", "leaveStatus", "vacationType"])->find($id);
        $this->user = User::query()->with(["experienceLevel", "position"])->find($this->leaves->user_id);
        $this->getStatus = LeaveStatus::all()->map(function ($leave) {
            return [
                "id" => $leave->id,
                "label" => $leave->label,
            ];
        });

        $this->status = $this->leaves->leaveStatus->label;
    }

    #[Title("Vacation user request")]
    public function render()
    {
        return view('livewire.admin.vacations.edit');
    }

    public function updated($propertyName, $value): void
    {
        if ($propertyName == "status" && $value == "Rejected") {
            $this->commentOn = true;

        } else if ($propertyName == "status" && $value != "Approved") {
            $this->commentOn = false;
        }
    }


    public function updateRequest(): void
    {
        if ($this->leaves->leaveStatus->label == $this->status) {
            $this->dispatch("alert",
                type: "info",
                title: "No changes made",
                text: "you doesn't change any thing in the status of this vacation."
            );
        } else {
            if ($this->status == "Rejected") {
                \DB::beginTransaction();
                // Tag the request as rejected
                Leaves::query()->where("id", $this->id)->update([
                    "leave_status_id" => LeaveStatus::query()->where("label", "like", $this->status)->first()->id
                ]);
                // take the amount who was sub to have request and add it another time
                User::query()->where("id", $this->leaves->user_id)->update([
                    'balance' => \DB::raw("balance + " . $this->leaves->leaves_days)
                ]);
                \DB::commit();
                // notify the user by the email that he's request was rejected
                $this->user->notify(new CongeInfo("Rejected request", $this->leaves, "Rejected"));
                $this->dispatch("alert",
                    type: "success",
                    title: "Success",
                    text: "Vacation status was successfully updated."
                );
            }
            else if($this->status == "Approved"){
                \DB::beginTransaction();
                // Tag the request as approved
                Leaves::query()->where("id", $this->id)->update([
                    "leave_status_id" => LeaveStatus::query()->where("label", "like", $this->status)->first()->id
                ]);
                \DB::commit();
                // notify the user by the email that he's request was rejected
                $this->user->notify(new CongeInfo("Approved request", $this->leaves, "Approved"));
                $this->dispatch("alert",
                    type: "success",
                    title: "Success",
                    text: "Vacation status was successfully updated."
                );
            }


        }
    }


}

