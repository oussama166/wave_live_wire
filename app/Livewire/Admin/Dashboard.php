<?php

namespace App\Livewire\Admin;

use App\Models\Holiday;
use App\Models\Leaves;
use App\Models\LeaveStatus;
use App\Models\User;
use App\Traits\DataExtractor;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    use DataExtractor;

    public $dataSet;
    public $dataSetNextHolidays;

    public function initializeComponent()
    {
        $this->dispatch('componentIsActive', 'Chart');
    }

    public function mount()
    {
        $this->dataSet = $this->getEmployeeDataByAvgSalary();
        $this->dataSetNextHolidays = $this->getTwoMonthNextHoliday();
    }

    #[Title("Admin dashboard")]
    public function render()
    {
        // Get all the pending leaves request
        $pendingRequest = Leaves::query()
            ->where(
                'leave_status_id',
                LeaveStatus::query()
                    ->where('label', 'Pending')
                    ->first()
                    ->getOriginal('id')
            )
            ->count();
        $hour = date('H');

        if ($hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }

        $salute =
            $greeting .
            ' ' .
            (auth()->user()->sexe == 'male' ? 'Mr.' : 'Ms.') .
            ' ' .
            auth()->user()->lastname .
            ' !';

        return view(
            'livewire.admin.dashboard',
            compact('pendingRequest', 'salute')
        );
    }

    public function getEmployeeDataByAvgSalary()
    {
        // Build the query
        $query = User::query()
            ->join('positions', 'positions.id', '=', 'users.position_id')
            ->select(
                'positions.label as position_label',
                \DB::raw('avg(salary) as numberEmp')
            )
            ->groupBy('positions.label');

        // Use the trait to extract labels (position labels) and data (average salaries)
        $dataset = $this->extractLabelsAndData(
            $query,
            'position_label', // Label column from the join
            'numberEmp' // Data column (average salary)
        );

        return $dataset;
    }

    public function getTwoMonthNextHoliday()
    {
        // Get the current year and month
        $getYear = date('Y'); // Use 'Y' for full year (e.g., 2024)
        $getMonth = date('m');

        // Get holidays for the next two months
        $holidayList = \App\Models\Holiday::query()
            ->whereYear('date', $getYear)
            ->where(function ($query) use ($getMonth) {
                $query
                    ->whereMonth('date', $getMonth)
                    ->orWhereMonth('date', $getMonth + 1)
                    ->orWhereMonth('date', $getMonth + 2);
            })
            ->get();
        return $holidayList;
    }
}
