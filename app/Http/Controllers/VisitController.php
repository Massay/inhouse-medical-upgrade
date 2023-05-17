<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitFormRequest;
use App\Models\Clinic;
use App\Models\Employee;
use App\Models\TreatmentType;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        return inertia('Visits/Index', [
            'visits' => Visit::with('employee', 'clinic', 'relative')->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return inertia('Visits/Create', [
            'clinics' => Clinic::all(),
            'employees' => Employee::with('relatives')->get(),
            'treatment_types' => TreatmentType::with('policy')->get()
        ]);
    }

    public function store(VisitFormRequest $request)
    {
        $data = $request->validated();

        //dd($data);
        Visit::create($data);
        return to_route('visits.index');
    }

    public function show(Visit $visit){

         return inertia("Visits/Show",[
            'visit' => $visit
         ]);
    }

    public function edit(Visit $visit)
    {
            return inertia("Visits/Edit",[
                'visit' => $visit,
                'clinics' => Clinic::all(),
                'employees' => Employee::with('relatives')->get(),
                'treatment_types' => TreatmentType::with('policy')->get()
            ]);
    }

    public function update(VisitFormRequest $request, Visit $visit)
    {

        //return $request->all();
        $visit->update($request->validated());
         return to_route('visits.index');
    }
}
