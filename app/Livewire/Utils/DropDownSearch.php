<?php

namespace App\Livewire\Utils;

use App\Models\User;
use App\Traits\DynamicTableQuery;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class DropDownSearch extends Component
{


    use WithPagination;
    use DynamicTableQuery;

    // VAR TO TRACK THE DATA TYPED BY THE USER
    public string $query = '';


    public string $label;
    public bool $labelOn = false;

    public function mount($labelOn = false, $label = ""): void
    {
        $this->labelOn = $labelOn;
        $this->label = $label;

    }

    public function render()
    {
        // RETURN SEARCH RESULT
        $data = $this->getData(
            '\App\Models\User',
            relations: ['position', 'contracts', 'experienceLevel'],
            searchText: $this->query,
        );
        return view('livewire.utils.drop-down-search', compact('data'));
    }


    public function updatedQuery(): void
    {
        $this->query = explode(' ', trim($this->query))[0];
    }





}
