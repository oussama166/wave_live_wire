<?php

namespace App\Livewire\Utils;

use App\Traits\DynamicTableQuery;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination, DynamicTableQuery;

    private $query;
    public $headers = ['Start date', 'End date', 'Type', 'State', 'Duration'];
    public $extract_key = [
        'start_at',
        'end_at',
        'vacation_type_id',
        'leave_status_id',
        'Duration',
    ];
    public $data = [];

    public $modelClass;
    public $relations = [];
    public $conditions = [];
    public $orderBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $paginate;

    public function mount(
        $modelClass,
        $relations = [],
        $conditions = [],
        $orderBy = 'created_at',
        $sortDirection = 'desc',
        $perPage = 10,
        $headers = [],
        $extract_key = []
    ) {
        $this->modelClass = $modelClass;
        $this->relations = $relations;
        $this->conditions = $conditions;
        $this->orderBy = $orderBy;
        $this->sortDirection = $sortDirection;
        $this->perPage = $perPage;
        $this->headers = $headers ?? $this->headers;
        $this->extract_key = $extract_key ?? $this->extract_key;

        $this->query = $this->getData(
            $this->modelClass,
            $this->relations,
            $this->conditions,
            $this->orderBy,
            $this->sortDirection,
            $this->perPage
        );

        $this->data = $this->query->get();
        dd($this->query->paginate(1));
    }

    public function render()
    {
        return view('livewire.utils.table', [
            'data' => $this->data,
        ]);
    }
}
