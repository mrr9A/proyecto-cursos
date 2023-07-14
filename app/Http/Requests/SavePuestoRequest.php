<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePuestoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // verifica si la accion esta autorizada
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // $idPuesto = $this->input('id_puesto');
        // // unique:usuarios,id_sgp,'.$userId.',id_usuario',
        // if($this->isMethod('PUT')){
        //     // retornamos diferentes validaciones
        //     return [
        //         //
        //         'codigo' => 'required|unique:puestos, codigo,'.$idPuesto.',id_puesto',
        //         'puesto' => 'required',
        //         'plan_id' => 'required',
        //         'trabajo' => 'array',
        //     ];
        // }
        return [
            //
            'codigo' => 'required|unique:puestos',
            'puesto' => 'required',
            'plan_id' => 'required',
            'trabajo' => 'array',
        ];
    }
}
