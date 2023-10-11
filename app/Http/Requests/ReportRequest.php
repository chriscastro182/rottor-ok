<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];
    }

    public function messages()
    {
        return array(
            'start_date.required' => 'Se necesita una fecha de inicio',
            'start_date.date' => 'No es un afecha valida',
            'end_date.required' => 'Se necesita una fecha final',
            'end_date.date' => 'No es un afecha valida',
        );
    }
}
