<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLeccionRequest extends FormRequest
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
            'nombre' => 'required|string|min:5',
            'descripcion' => 'required|string|min:5',
            'url_imagen' => 'required|image|mimes:png,jpg'
        ];
    }

    public function messages()
    {
        return [
            // VALIDACION DE NOMBRE
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena.',
            'nombre.min' => 'El campo nombre debe ser minimo 5 caracteres.',
            // VALIDACION DE DESCRIPCION
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'descripcion.string' => 'El campo descripcion debe ser una cadena.',
            'descripcion.min' => 'El campo descripcion debe ser minimo 5 caracteres.',
            // VALIDACION DE IMAGEN
            'url_imagen.required' => 'El campo imagen es obligatorio.',
            'url_imagen.image' => 'El campo imagen debe ser formato PNG,JPG.',
            'url_imagen.mimes' => 'El campo imagen debe ser formato PNG,JPG.',

        ];
    }
}