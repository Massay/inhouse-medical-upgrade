<?php

namespace App\ChartData;

use App\Logic\SortChartData;
use App\Models\Visit;
use DateTime;
use Illuminate\Support\Facades\DB;

class YearlyVisitsChartData
{

    public function __construct()
    {
        dd("this is monthly chart data");
    }

    public  static function  random_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    private function customSort($a, $b)
    {
        $aTimestamp = strtotime($a);
        $bTimestamp = strtotime($b);

        return $aTimestamp - $bTimestamp;
    }

    public static function data()
    {

        $now = now();
        $weekStartDate = $now->copy()->startOfYear()->format('Y-m-d');
        $weekEndDate = $now->copy()->endOfYear()->format('Y-m-d');

        $visits = Visit::query()
            ->selectRaw('DATE_FORMAT(date,"%M %Y") as date1, sum(amount) as count')
            ->whereDate('date', '>=', $weekStartDate)
            ->whereDate('date', '<=', $weekEndDate)
            ->orderBy('date1', 'desc')
            ->groupBy('date1')
            ->get()
            ->pluck('count', 'date1');



        $colors = [];

        for ($i = 0; $i < count($visits); $i++) {
            $colors[] = self::random_color();
        }

        // $collection = $visits;
        // $sortedCollection = $collection->sortBy(function ($value, $key) {
        //     // Extract month and year from the key
        //     $monthYear = explode(" ", $key);
        //     $month = $monthYear[0];
        //     $year = $monthYear[1];

        //     // Assign numeric values to months for sorting
        //     $months = [
        //         "January" => 1,
        //         "February" => 2,
        //         "March" => 3,
        //         "April" => 4,
        //         "May" => 5,
        //         "June" => 6,
        //         "July" => 7,
        //         "August" => 8,
        //         "September" => 9,
        //         "October" => 10,
        //         "November" => 11,
        //         "December" => 12
        //     ];

        //     // Calculate a sortable value based on year and month
        //     $sortableValue = $year * 100 + $months[$month];

        //     return $sortableValue;
        // });

        // $sortedArray = $sortedCollection->all();

        $sortedArray = SortChartData::sort($visits);




        return [
            'chart_data' => [
                'labels' => array_keys($sortedArray),
                'datasets' => array(
                    [
                        'label' => 'Amount spend of monthly:',
                        'backgroundColor' => $colors,
                        'data' =>  array_values($sortedArray)
                    ]
                )
            ],
            'board' => [
                array_combine(array_keys($sortedArray), array_values($sortedArray))
            ]
        ];
    }
}
