<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateGrupoRequest extends Request
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
            'nombre' => 'required',
            'email' => 'required|unique:cuenta,email',
            'ciudad' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'num_int' => 'required',
            'descripcion' => 'required',
            'password' => 'required|confirmed|min:6',
            //
        ];
    }
}
