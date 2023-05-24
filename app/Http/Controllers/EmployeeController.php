<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateFormRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Employee/Index',[
            'employees' => Employee::latest()->paginate(25),
            'can' => [
                'create' =>[
                    'employees' => $request->user()->can('create employees')
                ]
            ]
        ]);
    }

    public function edit(Request $request, Employee $employee){
            return 'edit';
    }

    public function show(Employee $employee){
        return $employee;
    }

    public function create(){
            return inertia('Employee/Create');
    }

    public function store(EmployeeCreateFormRequest $request){
        $data = $request->validated();
        Employee::create($data);
        return to_route('employees.index');
    }


    public function delete(Employee $employee){
          $employee->delete();

          return to_route('employees.index');
    }


    public function update(Request $request, Employee $employee){
        return 'update';
    }
}
