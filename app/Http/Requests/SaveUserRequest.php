<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
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
        $userId = $this->route('usuario');
        if ($this->isMethod('PATCH')) {
            // retornamos diferentes validaciones
            // .$usuario->id_usuario

            return [
                //gt:0 indicaq que solo numero positivos
                'nombre' => 'required|string|min:3',
                'segundo_nombre' => 'nullable|string|min:3',
                'apellido_paterno' => 'required|string|min:3',
                'apellido_materno' => 'nullable|string|min:3',
                'id_sgp' => 'required|numeric|gt:0|unique:usuarios,id_sgp,'.$userId.',id_usuario',
                'id_sumtotal' => 'required|numeric|gt:0|unique:usuarios,id_sumtotal,'.$userId.',id_usuario',
                'rol' => 'required|numeric',
                'sucursal_id' => 'required|numeric',
                'puesto_id' => 'required|numeric',
                'email' => 'required|email|unique:usuarios,email,'.$userId.',id_usuario',
                'password' => 'nullable|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'estado' => 'required|numeric',
                'trabajos' => 'required|array',
                'fecha_alta_planta' => 'nullable',
                'fecha_ingreso_puesto' => 'nullable'
            ];
        }
        return [
            //gt:0 indicaq que solo numero positivos
            'nombre' => 'required|string|min:3',
            'segundo_nombre' => 'nullable|string|min:3',
            'apellido_paterno' => 'required|string|min:3',
            'apellido_materno' => 'nullable|string|min:3',
            'id_sgp' => 'required|numeric|gt:0|unique:usuarios',
            'id_sumtotal' => 'required|numeric|gt:0|unique:usuarios',
            'rol' => 'required|numeric',
            'sucursal_id' => 'required|numeric',
            'puesto_id' => 'required|numeric',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'estado' => 'required|numeric',
            'trabajos' => 'required|array',
            'fecha_alta_planta' => 'nullable',
            'fecha_ingreso_puesto' => 'nullable'
        ];
    }
}
