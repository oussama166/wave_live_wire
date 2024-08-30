<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Contracts;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Holiday as ModelsHoliday;
use Illuminate\Support\Facades\Log;

class Holiday extends Component
{
    protected $listeners = [
        'changeDataHoliday' => 'changeDataHoliday',
        'deleteDataHoliday' => 'deleteDataHoliday',
        'handleTimeChange' => 'handleTimeChange',
    ];

    public int $id = -1;
    public string $holidayName = ' ';
    public $dateHoliday;
    public $holidayDayNumber = 1;
    public bool $isReligious = false;

    public $Holidays;

    #[Title("Adding Holiday")]
    public function render()
    {
        $this->getHolidaysList();
        return view('livewire.admin.settings.holiday');
    }

    public function getHolidaysList()
    {
        $currentYear = date('Y');
        $this->Holidays = ModelsHoliday::query()
            ->whereYear('date', $currentYear)
            ->orWhere('status', 'like', 'religious')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($holi) {
                return [
                    'id' => $holi->id,
                    'name' => $holi->name,
                    'date' => (new \DateTime($holi->date))->format('d M'),
                    'status' => $holi->status,
                ];
            });
    }

    public function updateHoliday()
    {
        if ($this->id != -1) {
            ModelsHoliday::query()
                ->where('id', $this->id)
                ->update([
                    'name' => $this->holidayName,
                    'date' => $this->dateHoliday,
                    'days_number' => $this->holidayDayNumber,
                    'status' => $this->isReligious ? 'religious' : 'national',
                ]);
        } else {
            ModelsHoliday::query()->create([
                'name' => $this->holidayName,
                'date' => $this->dateHoliday,
                'days_number' => $this->holidayDayNumber,
                'status' => $this->isReligious ? 'religious' : 'national',
            ]);
        }
        $this->reset();
    }

    #[On('changeDataHoliday')]
    public function changeDataHoliday($id): void
    {
        $holidayData = ModelsHoliday::query()->find($id);
        $this->id = $holidayData->id;
        $this->holidayName = $holidayData->name;
        $this->dateHoliday = $holidayData->date;
        $this->holidayDayNumber = $holidayData->days_number;
        $this->isReligious = $holidayData->status == 'religious';
        $this->needUpdate = true;
    }

    #[On('deleteDataHoliday')]
    public function deleteDataHoliday($id): void
    {
        $contractData = ModelsHoliday::query()->find($id);
        $contractData->delete();
    }

    #[On('handleTimeChange')]
    public function handleTimeChange($model, $value): void
    {
        $this->{$model} = $value;
    }
}
