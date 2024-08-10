<?php

namespace App\Traits;

trait DataExtractor
{

    /**
     * Extract labels and data from a query.
     *
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $query
     * @param string $labelColumn
     * @param string $dataColumn
     * @param int|null $threshold
     * @param string $operator
     * @param callable|null $modifyQuery
     * @return object
     */
    public function extractLabelsAndData($query, $labelColumn, $dataColumn, $threshold = null, $operator = '>', callable $modifyQuery = null)
    {
        // Apply additional modifications to the query if provided
        if ($modifyQuery) {
            $query = $modifyQuery($query);
        }

        // Apply threshold filter if a threshold is provided
        if ($threshold !== null) {
            $query->where($dataColumn, $operator, $threshold);
        }

        // Execute the query and get the results
        $results = $query->get([$labelColumn, $dataColumn]);

        // Extract labels and data
        $labels = $results->pluck($labelColumn)->toArray();
        $data = $results->pluck($dataColumn)->toArray();

        // Return an object with labels and data
        return (object)[
            'labels' => $labels,
            'data' => $data,
        ];
    }
}

