<?php

namespace App\Http\Controllers;

use App\Http\Requests\TreatmentConfigFormRequest;
use App\Models\Policy;
use App\Models\TreatmentType;
use App\Models\User;
use Illuminate\Http\Request;

class TreatmentConfigController extends Controller
{
    public function index()
    {

        $data = TreatmentType::with('policy')->get();
        return inertia('TreatmentConfig/Index', [
            'treatments' => $data,
            'name' => 'Massay Bah'
        ]);
    }

    public function create()
    {
        return inertia('TreatmentConfig/Create', [
            'policies' => Policy::all()
        ]);
    }

    public function store(TreatmentConfigFormRequest $request)
    {
        $data = $request->validated();

        TreatmentType::create($data);

        return to_route('settings.treatment.config');
    }
}
