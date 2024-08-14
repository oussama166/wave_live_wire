<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait DynamicTableQuery
{
    /**
     * Get data dynamically based on provided parameters.
     *
     * @param string $modelClass The model class to query.
     * @param array $relations Relationships to eager load.
     * @param array $conditions Conditions to apply on the query.
     * @param string $orderBy Column to sort by.
     * @param string $sortDirection Direction of the sort (asc/desc).
     * @param number $peerPage Number of items per page.
     * @return modelClass::query
     */
    function getData(
        string $modelClass,
        array  $relations = [],
        array  $conditions = [],
        string $orderBy = 'created_at',
        string $sortDirection = 'desc',
        int   $perPage = 10,
        ?string $searchText = null
    )
    {
        $query = $modelClass::query();

        // Apply conditions
        foreach ($conditions as $condition) {
            $query->where(...$condition);
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
                    $query->where('name', 'like', "%{$searchText}%")
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
