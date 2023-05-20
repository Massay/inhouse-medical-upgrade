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
            $colors[] = RandomColor::random_color();
        }

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
