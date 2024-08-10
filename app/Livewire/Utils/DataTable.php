<?php

namespace App\Livewire\Utils;

use App\Traits\DynamicTableQuery;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination, DynamicTableQuery;

    public $headers = ['Start date', 'End date', 'Type', 'State', 'Duration'];
    public $extractKey = ['start_at', 'end_at', 'vacation_type_id', 'leave_status_id', 'Duration'];
    public $actionOn = false;
    public $key;


    public $modelClass;
    public $relations = [];
    public $conditions = [];
    public $orderBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = "5";

    public function mount(
        $modelClass,
        $relations = [],
        $conditions = [],
        $orderBy = 'created_at',
        $sortDirection = 'desc',
        $perPage = 10,
        $headers = [],
        $extractKey = [],
        $actionOn = false
    )
    {
        $this->modelClass = $modelClass;
        $this->relations = $relations;
        $this->conditions = $conditions;
        $this->orderBy = $orderBy;
        $this->sortDirection = $sortDirection;
        $this->perPage = $perPage;
        $this->headers = $headers ?: $this->headers;
        $this->extractKey = $extractKey ?: $this->extractKey;
        $this->actionOn = $actionOn;
    }

    public function render()
    {
        $data = $this->getData(
            $this->modelClass,
            $this->relations,
            $this->conditions,
            $this->orderBy,
            $this->sortDirection,
            $this->perPage,
        );

        return view('livewire.utils.data-table', compact('data'));
    }

    public function updatedPeerPage($value)
    {
    }
}
