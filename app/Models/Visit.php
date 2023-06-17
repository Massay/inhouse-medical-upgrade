<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        'clinic_id',
        'date',
        'employee_id',
        'invoice_no',
        'amount',
        'policy_id',
        'relative_id',
        'company_amount',
        'employee_amount',
        'is_employee_visit',
        'patient_name',
        'treatment_type_id',
        'exceeded_amount'
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function treatment_type()
    {
        return $this->belongsTo(TreatmentType::class);
    }

    public function relative()
    {
        return $this->belongsTo(Relative::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }








    protected static function boot()
    {
        parent::boot();

        Visit::creating(function($model) {
            $model->user_id = auth()->id();
        });

        // Visit::updating(function($model){
        //     $model->user_updated_by = auth()->id();
        // });
    }
}
