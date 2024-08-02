<?php

namespace App\Livewire\Utils;

use App\Models\Leaves;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Calendar extends Component
{
    public $events = [];

    public function mount($events)
    {
        $this->events = $events;
    }
    public function render()
    {
        $this->events = $this->getEvents();

        return view('livewire.utils.calendar');
    }

    private function getEvents()
    {
        $userVacations = Leaves::query()
            ->with(['User', 'VacationType', 'LeaveStatus'])
            ->where('user_id', Auth::id())
            ->get([
                'id',
                'start_at',
                'end_at',
                'vacation_type_id',
                'leave_status_id',
            ]);

        $calendarEvents = $userVacations->map(function ($vacation) {
            return [
                'id' => (string) $vacation->id,
                'calendarId' => '1',
                'title' => $vacation->vacationType->label,
                'category' => 'allday',
                'start' => $vacation->start_at,
                'end' => $vacation->end_at,
                'state' => $vacation->leaveStatus->label,
                'backgroundColor' => $vacation->vacationType->backgroundColor,
                'isReadOnly' => true,
            ];
        });

        return $calendarEvents->toJson(JSON_UNESCAPED_UNICODE);
    }
}
