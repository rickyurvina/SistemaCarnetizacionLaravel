<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
            'PER_CEDULA'=>'required|min:10',
            'PER_NOMBRES'=>'required',
            'PER_APELLIDOS'=>'required',
            'PER_SEXO'=>'required',
            'PER_FECHANACIMIENTO'=>'required',
            'PER_TIPOSANGRE'=>'required',
            'PER_CORREO'=>'required|email',
            'PER_DIRECCION'=>'nullable',
            'PER_NUMERO'=>'min:7',
            'PER_CELULAR'=>'min:10',
            'institution_id'=>'required',
        ];
    }
}
