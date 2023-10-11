<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewAppointment extends FormRequest
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
           'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'cellphone' => 'required',
            'email' => 'required|email:rfc',
            'day' => 'required|date',
            'hour' => 'required',
            'terms_check' => 'accepted',
            'privacy_check' => 'accepted'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El nombre es obligatorio",
            'lastname.required' => "El apellido es obligatorio",
            'phone.required' => "El teléfono es obligatorio",
            'cellphone.required' => "El celular es obligatorio",
            'email.required' => "El correo electrónico es obligatorio",
            'email.email' => "El correo electrónico no tiene el formato correcto",
            'day.required' => "La fecha de cita es obligatoria",
            'day.date' => "La fecha de cita no tiene el formato adecuado",
            'hour.required' => "La hora de la cita es obligatoria",
            'terms_check.accepted' => "Se deben de aceptar los Términos y Condiciones",
            'privacy_check.accepted' => "Se debe de aceptar el Aviso de Privacidad",
        ];
    }


}
