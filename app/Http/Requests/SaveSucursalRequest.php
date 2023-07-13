<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSucursalRequest extends FormRequest
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
        $id_sucursal = $this->input("id_sucursal");
        if ($this->isMethod('PATCH')) {
            return [
                'nombre' => 'required|string',
                'ciudad' => 'required|string',
                'codigo' => 'required|string|unique:sucursales,codigo,'.$id_sucursal.',id_sucursal',
                'estado' => 'required',
            ];
        }

        return [
            'nombre' => 'required|string',
            'ciudad' => 'required|string',
            'codigo' => 'required|string|unique:sucursales',
        ];
    }
}
