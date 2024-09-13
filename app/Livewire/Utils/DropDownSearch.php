<?php

namespace App\Livewire\Utils;

use App\Models\User;
use App\Traits\DynamicTableQuery;
use Livewire\Component;
use Livewire\WithPagination;

class DropDownSearch extends Component
{
    use WithPagination;
    use DynamicTableQuery;

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
        $data = $this->searchUsers($this->query);
        return view('livewire.utils.drop-down-search', compact('data'));
    }

    public function updatedQuery(): void
    {
        // This method is triggered when the query changes
        $this->query = trim($this->query);
    }

    public function search()
    {
        // Call the search method when the button is clicked
        $this->dispatch('searchPerformed');
    }

    private function searchUsers(string $query)
    {
        $query = trim($query);

        // If the query is empty, return an empty collection or adjust as needed
        if (empty($query)) {
            return collect([]);
        }

        // Assuming getData method is used to apply search logic
        return $this->getData(
            '\App\Models\User',
            relations: ['position', 'contracts', 'experienceLevel'],
            searchText: $query
        );
    }
}
