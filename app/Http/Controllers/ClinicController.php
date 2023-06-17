<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index()
    {
        return inertia('Partners/Index',[
            'clinics' => Clinic::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return inertia('Partners/Create');
    }

    public function store(Request $request)
    {
         $request->validate([
                'name' => 'required',
                'address' => 'nullable',
                'contact' => 'nullable'
         ]);
            $clinic = new Clinic();
            $clinic->name = $request->name;
            $clinic->address = $request->address;
            $clinic->contact = $request->contact;
            $clinic->save();
           return to_route('partners.index');



    }
}
