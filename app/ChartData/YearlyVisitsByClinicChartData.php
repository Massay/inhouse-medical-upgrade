<?php

namespace App\ChartData;

use App\Models\Visit;
class YearlyVisitsByClinicChartData
{


    public static function data()
    {

        $now = now();
        $weekStartDate = $now->copy()->startOfYear()->format('Y-m-d');
        $weekEndDate = $now->copy()->endOfYear()->format('Y-m-d');


       $visits = Visit::query()
             ->join('clinics', 'visits.clinic_id', '=', 'clinics.id')
            ->selectRaw('sum(amount) as amount, clinics.name')
            ->whereDate('date', '>=', $weekStartDate)
            ->whereDate('date', '<=', $weekEndDate)
            ->orderBy('name', 'desc')
            ->groupBy('name')
            ->get()
            ->pluck('amount','name');




        $colors = [];

        for ($i = 0; $i < count($visits); $i++) {
            $colors[] = RandomColor::random_color();
        }

        // dd($visits->keys);
            return [
                'chart_data' => [
                    'labels' => $visits->keys(),
                    'datasets' => array(
                        [
                            'label' => 'Amount spend:',
                            'backgroundColor' => $colors,
                            'data' =>  $visits->values()
                        ]
                    )
                ],
                'board' => [

                ]
            ];
    }
}
