<?php

namespace App\Livewire\Utils;

use App\Traits\DynamicTableQuery;
use Livewire\Component;
use Livewire\WithPagination;


class Table extends Component
{
    use WithPagination, DynamicTableQuery;


    public $headers = ['Start date', 'End date', 'Type', 'State', 'Duration'];
    public $extractKey = [
        'start_at',
        'end_at',
        'vacation_type_id',
        'leave_status_id',
        'Duration',
    ];
    public $whereHasConditions = [];
    public $withJson = [];
    public $actionOn = false;
    public $searchOn = false;
    public $paginationArea = false;
    public $key;
    public $type = 'satic';
    public $search = '';

    public $modelClass;
    public $relations = [];
    public $conditions = [];
    public $orderBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 5;
    public $holidayCounter = false;

    public function mount(
        $modelClass,
        $orderBy = 'created_at',
        $sortDirection = 'desc',
        $type = 'satic',
        $search = '',
        $perPage = 5,
        $actionOn = false,
        $searchOn = false,
        $paginationArea = false,
        $withJson = [],
        $relations = [],
        $conditions = [],
        $headers = [],
        $whereHasConditions = [],
        $extractKey = [],
        $holidayCounter = false
    ) {
        $this->modelClass = $modelClass;
        $this->relations = $relations;
        $this->conditions = $conditions;
        $this->orderBy = $orderBy;
        $this->sortDirection = $sortDirection;
        $this->perPage = $perPage;
        $this->headers = $headers ?: $this->headers;
        $this->extractKey = $extractKey ?: $this->extractKey;
        $this->actionOn = $actionOn;
        $this->search = $search;
        $this->whereHasConditions = $whereHasConditions;
        $this->searchOn = $searchOn;
        $this->paginationArea = $paginationArea;
        $this->type = $type;
        $this->withJson = $withJson;
        $this->holidayCounter = $holidayCounter;
    }

    public function render()
    {
        $data = $this->getData(
            $this->modelClass,
            $this->relations,
            $this->conditions,
            $this->whereHasConditions,
            $this->orderBy,
            $this->sortDirection,
            $this->perPage,
            $this->withJson,
            $this->search
        );

        return view('livewire.utils.table', [
            'data' => $data,
        ]);
    }
}
