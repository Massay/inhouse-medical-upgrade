<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Employee;
use App\Models\TreatmentType;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return inertia('Reports/Index');
    }

    public function monthly()
    {
        return inertia('Reports/Monthly',[
            'clinics' => Clinic::select('id','name')->get()
        ]);
    }

    public function customDate(Request $request)
    {

        // $start_date = Carbon::parse($request->start_date);
        // $end_date = Carbon::parse($request->end_date);


        $visits = Visit::with('employee', 'clinic', 'relative')
            ->when($request->clinic_id, function ($query, $value) {
                $query->where('clinic_id', '=', $value);
            })
            ->when($request->employee_id, function ($query, $value) {
                $query->where('employee_id', '=', $value);
            })
            ->when($request->start_date, function ($query, $value) {
                $query->whereDate('date', '>=', $value);
            })
            ->when($request->end_date, function ($query, $value) {

                $query->whereDate('date', '<=', $value);
            })
            ->latest()
            ->paginate(25)
            ->withQueryString();


        return inertia('Reports/CustomDateReport', [
            'visits' => $visits,
            'filters' => $request->only(['start_date', 'end_date']),
            'employees' => Employee::all()->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'no' => $item['no'],
                    'name' => $item['firstname'] . ' ' . $item['middlename'] . ' ' . $item['lastname']
                ];
            }),
            'clinics' => Clinic::all()->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                ];
            })
        ]);
    }


    public function familyReport()
    {
        return inertia('Reports/FamilyReport');
    }

    public function treatmentType()
    {
        return inertia('Reports/TreatmentTypeReport',[
            'treatment_types' => TreatmentType::select('id','name')->get()
        ]);
    }
}
