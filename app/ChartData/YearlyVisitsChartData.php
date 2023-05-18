<?php

namespace App\ChartData;

use App\Models\Visit;

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

    public static function data()
    {

        $now = now();
        $weekStartDate = $now->copy()->startOfYear()->format('Y-m-d');
        $weekEndDate = $now->copy()->endOfYear()->format('Y-m-d');

        $visits = Visit::query()
            ->selectRaw('MONTHNAME(date) as date1, sum(amount) as count')
            ->whereDate('date', '>=', $weekStartDate)
            ->whereDate('date', '<=', $weekEndDate)
            ->orderByRaw('date1')
            ->groupByRaw('date1')
            ->get()
            ->pluck('count', 'date1');

        $colors = [];

        for ($i = 0; $i < count($visits); $i++) {
            $colors[] = self::random_color();
        }

        return [
            'labels' => $visits->keys(),
            'datasets' => array(
                [
                    'label' => 'Amount spend of Per Day in '.  $now->format('Y'),
                    'backgroundColor' => $colors,
                    'data' => $visits->values()
                ]
            )
        ];
    }
}
