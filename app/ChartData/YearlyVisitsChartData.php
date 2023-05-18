<?php

namespace App\ChartData;

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

    public static function data()
    {

        $now = now();
        $weekStartDate = $now->copy()->startOfYear()->format('Y-m-d');
        $weekEndDate = $now->copy()->endOfYear()->format('Y-m-d');

        $visits = Visit::query()
            ->selectRaw('DATE_FORMAT(date,"%M %Y") as date1, sum(amount) as count')
            ->whereDate('date', '>=', $weekStartDate)
            ->whereDate('date', '<=', $weekEndDate)
            ->orderBy('date1','desc')
            ->groupBy('date1')
            ->get()
            ->pluck('count', 'date1');

        // $visits = DB::table("visits")
        //     ->select(DB::raw('EXTRACT(MONTH FROM date) AS month, sum(amount) as count'))
        //     ->whereDate('date', '>=', $weekStartDate)
        //     ->whereDate('date', '<=', $weekEndDate)
        //     ->orderBy('date')
        //     ->groupBy(DB::raw('month'))
        //     ->get()
        //     ->pluck('count', 'month');

        // $visits = Visit::select(DB::raw('SUM(amount) as data'), DB::raw("YEAR(date) year"),DB::raw('MONTH(date) months'),  DB::raw('MONTHNAME(date) month'))
        // ->groupBy('year')
        // ->groupBy('months')
        // ->orderBy('year', 'ASC')
        // ->orderBy('months', 'ASC')
        // ->get();
        // dd($visits);

            // ->map(function($item){
            //     return [
            //         'id' => $item['count'],
            //         'name' => $item['month']
            //     ];
            // });
            //->pluck('count', 'month');


        //    dd($visits);
           // ->pluck('count', 'month');

        //     function($item){
        //         return $item->date->format('MM');
        //         //DB::raw('month')
        //    }


            // dd($visits);

        $colors = [];

        for ($i = 0; $i < count($visits); $i++) {
            $colors[] = self::random_color();
        }


        $monthValues = $visits->values()->toArray();

        $monthKeys = $visits->keys()->toArray();




        usort($monthKeys, function($a, $b) {
            $dateA = DateTime::createFromFormat('M Y', $a);
            $dateB = DateTime::createFromFormat('M Y', $b);
            return $dateA <=> $dateB;
        });

        return [
            'labels' => $monthKeys,
            'datasets' => array(
                [
                    'label' => 'Amount spend of Per Day:',
                    'backgroundColor' => $colors,
                    'data' =>  $monthValues
                ]
            )
        ];
    }
}
