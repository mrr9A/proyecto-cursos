<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContenidoRequest extends FormRequest
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
            'nombre' => 'required|string|min:5|max:45',
            'descripcion' => 'required|string|min:5',
            'url' => 'required|mimes:pdf,txt,jpg,jpeg,png,gif,mp4'
        ];
    }

    public function messages()
    {
        return [
            // VALIDACION DE NOMBRE
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena.',
            'nombre.min' => 'El campo nombre debe ser minimo 5 caracteres.',
            'nombre.max' => 'El campo nombre debe ser maximo 255 caracteres.',
            // VALIDACION DE DESCRIPCION
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'descripcion.string' => 'El campo descripcion debe ser una cadena.',
            'descripcion.min' => 'El campo descripcion debe ser minimo 5 caracteres.',
            // VALIDACION DE IMAGEN
            'url.required' => 'El campo ARCHIVO es obligatorio.',
            'url.mimes' => 'El campo ARCHIVO debe ser formato pdf,txt,jpg,jpeg,png,gif.',
            'url.max' => 'El campo ARCHIVO debe ser menor a 50MB.',

        ];
    }
}