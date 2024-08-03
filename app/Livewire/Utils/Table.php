<?php

namespace App\Livewire\Utils;

use App\Traits\DynamicTableQuery;
use Livewire\Component;
use Livewire\WithPagination;


class Table extends Component
{
    use WithPagination, DynamicTableQuery;

    public $headers = ['Start date', 'End date', 'Type', 'State', 'Duration'];
    public $extractKey = ['start_at', 'end_at', 'vacation_type_id', 'leave_status_id', 'Duration'];

    public $modelClass;
    public $relations = [];
    public $conditions = [];
    public $orderBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    public function mount(
        $modelClass,
        $relations = [],
        $conditions = [],
        $orderBy = 'created_at',
        $sortDirection = 'desc',
        $perPage = 10,
        $headers = [],
        $extractKey = []
    ) {
        $this->modelClass = $modelClass;
        $this->relations = $relations;
        $this->conditions = $conditions;
        $this->orderBy = $orderBy;
        $this->sortDirection = $sortDirection;
        $this->perPage = $perPage;
        $this->headers = $headers ?: $this->headers;
        $this->extractKey = $extractKey ?: $this->extractKey;
    }

    public function render()
    {
        $data = $this->getData(
            $this->modelClass,
            $this->relations,
            $this->conditions,
            $this->orderBy,
            $this->sortDirection,
            $this->perPage
        );

        return view('livewire.utils.table', [
            'data' => $data,
        ]);
    }
}
