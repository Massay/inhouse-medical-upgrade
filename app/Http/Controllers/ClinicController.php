<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index()
    {
        return inertia('Partners/Index',[
            'clinics' => Clinic::paginate(10)
        ]);
    }
}
