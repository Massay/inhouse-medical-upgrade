<?php

namespace App\Http\Controllers;

use App\Models\TreatmentType;
use App\Models\Visit;
use Illuminate\Http\Request;

class TreatmentTypeReportController extends Controller
{
     public function showTreatmentTypeDetailsByID($reportId){
            $treatmentType = TreatmentType::find($reportId);
            $data = Visit::where('treatment_type_id', $reportId)
            ->orderBy('employee_id','DESC')
            ->get();

            $data->load('employee','clinic');

            //$data->groupBy('employee_id');
            //return $data->groupBy('employee.no');

            return inertia("Reports/TreatmentTypeReports/ReportIndex",[
                'type' =>$treatmentType->load('policy'),
                'data' => $data->groupBy('employee.no')
            ]);
     }
}
