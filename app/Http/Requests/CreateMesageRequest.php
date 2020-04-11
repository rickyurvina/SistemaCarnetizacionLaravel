<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMesageRequest extends FormRequest
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

          return[
                'INS_NOMBRE'=>'required',
                'INS_DIRECCION'=>'required',
                'INS_TELEFONO'=>'required|min:7',
                'INS_CELULAR'=>'required|min:10'
            ];

    }
}
