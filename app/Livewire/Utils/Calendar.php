<?php

namespace App\Livewire\Utils;

use App\Models\Holiday;
use App\Models\Leaves;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Calendar extends Component
{
    public $events = [];
    public $holidays = [];

    public function mount($events)
    {
        $this->events = $events;
        $this->holidays = $this->getHolidays();
    }
    public function render()
    {
        $this->events = $this->getEvents();
        $this->holidays = $this->getHolidays();

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
    public function getHolidays()
    {
        $holidays = Holiday::query()
            ->where('status', 'national')
            ->get(['id', 'name', 'date', 'days_number', 'status']);

        $calendarHolidays = $holidays->map(function ($holiday) {
            return [
                'id' => (string) $holiday->id,
                'calendarId' => '2',
                'title' => $holiday->name,
                'category' => 'allday',
                'start' => $holiday->date,
                'end' =>
                    $holiday->status != 'national'
                        ? (new DateTime($holiday->date))
                            ->modify('+' . $holiday->days_number . ' days')
                            ->format('Y-m-d')
                        : $holiday->date,
                'backgroundColor' => '#f6b352',
                'isReadOnly' => true,
            ];
        });

        return $calendarHolidays->toJson(JSON_UNESCAPED_UNICODE);
    }
}
