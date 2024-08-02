<?php

namespace App\Traits;

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
     * @return modelClass::query
     */
    function getData(
        string $modelClass,
        array  $relations = [],
        array  $conditions = [],
        string $orderBy = 'created_at',
        string $sortDirection = 'desc',
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

        // Apply sorting
        $query->orderBy($orderBy, $sortDirection);



        // Paginate the results
        return $query->paginate(4);
    }
}
