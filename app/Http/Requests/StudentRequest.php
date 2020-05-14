<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'EST_CEDULA'=>'required|min:10',
            'EST_NOMBRES'=>'required',
            'EST_APELLIDOS'=>'required',
            'EST_SEXO'=>'required',
            'EST_FECHANACIMIENTO'=>'required',
            'EST_TIPOSANGRE'=>'required',
            'EST_CORREO'=>'required',
            'EST_DIRECCION'=>'required',
            'EST_NUMERO'=>'min:7',
            'EST_CELULAR'=>'min:10',
            'EST_CODIGO'=>'nullable',
            'EST_MATRICULA'=>'nullable',
            'EST_INSCRITO'=>'nullable',
            'EST_NROMATRICULA'=>'nullable',
            'EST_RETIRADO'=>'nullable',
            'EST_BECA'=>'nullable',
            'course_id'=>'required',
            'institution_id'=>'required',
        ];
    }
}
