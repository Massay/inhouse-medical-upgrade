<?php

namespace App\Logic;


class SortChartData
{
    public static function sort($data)
    {

        $sortedCollection = $data->sortBy(function ($value, $key) {
            // Extract month and year from the key
            $monthYear = explode(" ", $key);
            $month = $monthYear[0];
            $year = $monthYear[1];

            // Assign numeric values to months for sorting
            $months = [
                "January" => 1,
                "February" => 2,
                "March" => 3,
                "April" => 4,
                "May" => 5,
                "June" => 6,
                "July" => 7,
                "August" => 8,
                "September" => 9,
                "October" => 10,
                "November" => 11,
                "December" => 12
            ];

            // Calculate a sortable value based on year and month
            $sortableValue = $year * 100 + $months[$month];

            return $sortableValue;
        });
        return $sortedCollection->all();
    }
}
