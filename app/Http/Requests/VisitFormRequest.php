<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
             'clinic_id' => 'required',
             'date' => 'required',
             'employee_id' => 'required',
             'invoice_no' => 'nullable',
             'amount' => 'required',
             'policy_id' => 'required',
             'company_amount' => 'required',
             'employee_amount' => 'required',
             'treatment_type_id' => 'required',
             'relative_id' => 'required_if:visit_type_id,2',
             'patient_name' => 'required',
             'is_employee_visit' => 'required',
             'exceeded_amount' => 'nullable'
        ];
    }
}
