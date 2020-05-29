<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionMesageRequest extends FormRequest
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
//        dd($this->route('institution'));
          return[
                'INS_NOMBRE'=>'required|unique:institutions,INS_NOMBRE,'.$this->route('institution'),
                'INS_DIRECCION'=>'required',
                'INS_TELEFONO'=>'required|min:7',
                'INS_CELULAR'=>'required|min:10',
                 'INS_TIPO'=>'required',
              'INS_MISION'=>'nullable',
              'INS_VISION'=>'nullable'
            ];
    }
}
