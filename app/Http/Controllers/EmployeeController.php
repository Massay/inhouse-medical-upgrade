<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return inertia('Employee/Index',[
            'employees' => Employee::paginate(25)
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

    public function store(Request $request){
        return 'store';
    }



    public function update(Request $request, Employee $employee){
        return 'update';
    }
}
