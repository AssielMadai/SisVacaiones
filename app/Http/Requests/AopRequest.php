<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AopRequest extends FormRequest
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
            'input-nombreAop' => 'required|min:10',
            'input-NIT' => 'required|unique:aops,nit',
//            'input-CodigoCatastral' =>'required',
            'select-Estado' =>'required|not_in:0',
            'select-Categoria' =>'required|not_in:0',
            'select-Sector' =>'required|not_in:0',
            'representante'=>'required|not_in:0'
        ];
    }


    public function messages()
    {
        return[
//            validaciones del nomber de AOP
            'input-nombreAop.required'=>'El campo Nombre es obligatorio',
            'input-nombreAop.min'=>'El campo debe tener como minimo 10 caracteres',
//            'input-nombreAop.max'=>'El campo debe tener como maximo 50 caracteres',
//            'input-nombreAop.regex' => 'El campo Nombre solo acepta letras',
//            validaciones del NIT
            'input-NIT.required'=>'El campo NIT es obligatorio',
            'input-NIT.uninque'=>'Esta AOP ya esta registrada',
//            validaciones del codigo de suelo
            'input-CodigoCatastral.required'=>'El campo Codigo de suelo es obligatorio',
//            validacion de select estado, sector, categoria
            'select-Estado.required'=>'Debe seleccionar un Estado',
            'select-Estado.not_in'=>'Debe seleccionar un Estado',
            'select-Categoria.required'=>'Debe seleccionar una Categoria',
            'select-Categoria.not_in'=>'Debe seleccionar una Categoria',
            'select-Sector.required'=>'Debe seleccionar un Sector',
            'select-Sector.not_in'=>'Debe seleccionar un Sector',
            'representante.required'=>'Debe seleccionar un Representante',
            'representante.not_in'=>'Debe seleccionar un Representante',
        ];
    }
}
