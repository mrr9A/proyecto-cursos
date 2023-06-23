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
        if ($this->isMethod('PATCH')) {
            // retornamos diferentes validaciones
        }
        return [
            //
            'nombre'=> 'required|string|min:5',
            'segundo_nombre' => 'string',
            'apellido_paterno' => 'required|string|min:5',
            'apellido_materno' => 'string',
            'id_sgp' => 'required|numeric|unique:usuarios',
            'id_sumtotal' => 'required|numeric|unique:usuarios',
            'rol'=> 'required|string',
            'sucursal_id' => 'required|numeric',
            'puesto_id' => 'required|numeric',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'estado' => 'required|numeric',
            'trabajos' => 'required|array',
        ];
    }
}
