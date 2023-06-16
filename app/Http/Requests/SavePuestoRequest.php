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

        if($this->isMethod('PATCH')){
            // retornamos diferentes validaciones
        }
        return [
            //
            'puesto' => 'required',
            'plan_id' => 'required',
            'trabajo' => 'array',
        ];
    }
}
