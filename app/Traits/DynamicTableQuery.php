<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

trait DynamicTableQuery
{
    /**
     * Get data dynamically based on provided parameters.
     *
     * @param string $modelClass The model class to query.
     * @param array $relations Relationships to eager load.
     * @param array $conditions Conditions to apply on the query.
     * @param array $whereHasConditions Conditions to apply using whereHas.
     * @param string $orderBy Column to sort by.
     * @param string $sortDirection Direction of the sort (asc/desc).
     * @param int $perPage Number of items per page.
     * @param string|null $searchText Text to search within specific fields.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    function getData(
        string $modelClass,
        array $relations = [],
        array $conditions = [],
        array $whereHasConditions = [],
        string $orderBy = 'created_at',
        string $sortDirection = 'desc',
        int $perPage = 10,
        array $withJson = [],
        ?string $searchText = null
    ) {
        $query = $modelClass::query();

        // Apply conditions
        foreach ($conditions as $condition) {
            $query->where(...$condition);
        }

        // Apply whereHas conditions if provided
        if (!empty($whereHasConditions)) {
            foreach ($whereHasConditions as $relation => $whereHasCondition) {
                $query->whereHas($relation, function (Builder $query) use (
                    $whereHasCondition
                ) {
                    foreach ($whereHasCondition as $condition) {
                        $query->where(...$condition);
                    }
                });
            }
        }

        if (!empty($withJson)) {
            $query->selectJsonValues($withJson['column'], $withJson['keys']);
        }

        // Apply relationships
        if (!empty($relations)) {
            $query->with($relations);
        }

        // Apply search filter using the scope if defined
        if (method_exists($modelClass, 'scopeSearch')) {
            $query->search($searchText);
        } else {
            if ($searchText) {
                $query->where(function (Builder $query) use ($searchText) {
                    $query
                        ->where('name', 'like', "%{$searchText}%")
                        ->orWhere('lastname', 'like', "%{$searchText}%")
                        ->orWhere('phone', 'like', "%{$searchText}%");
                });
            }
        }

        // Apply sorting
        $query->orderBy($orderBy, $sortDirection);

        // Paginate the results
        return $query->paginate($perPage);
    }
}
