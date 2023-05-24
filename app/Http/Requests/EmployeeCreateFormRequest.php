<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateFormRequest extends FormRequest
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
            'firstname'=> 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'address' => 'nullable',
            'no'=> 'required',
            'job_title'=>'required',
            'department' => 'required',
            'email' => 'required|email'
        ];
    }
}
