<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCursoInternoRequest extends FormRequest
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
            'codigo' => 'required|string|min:5 |unique:cursos',
            'nombre' => 'required|string|min:5',
            'fecha_inicio' => 'required',
            'fecha_termino' => 'required',
            'imagen' => 'required',
            'estado' => 'required',
            'modalidad_id' => 'required',
            'tipo_curso_id' => 'required',
            'interno_planta' => 'required',
            'categoria_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // VALIDACION DE CODIGO
            'codigo.required' => 'El campo codigo es obligatorio.',
            'codigo.string' => 'El campo codigo debe ser una cadena.',
            'codigo.min' => 'El campo codigo debe ser minimo 5 caracteres.',
            'codigo.unique' => 'El campo codigo es unico.',
            // VALIDACION DE NOMBRE
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena.',
            'nombre.min' => 'El campo nombre debe ser minimo 5 caracteres.',
            // VALIDACION DE IMAGEN
            'imagen.required' => 'El campo imagen es obligatorio.',
            'imagen.image' => 'El campo imagen debe ser formato png,jpg.',
            'imagen.mimes' => 'El campo imagen debe ser formato png,jpg.',
            // VALIDACION DE FECHA INICIO
            'fecha_inicio.required' => 'El campo fecha inicio es obligatorio.',
            'fecha_inicio.date' => 'El campo fecha inicio debe ser una fecha válida.',
            // VALIDACION DE FECHA TERMINO
            'fecha_termino.required' => 'El campo fecha termino es obligatorio.',
            'fecha_termino.date' => 'El campo fecha termino debe ser una fecha válida.',
            // VALIDACION DE MODALIDAD DEL CURSO
            'modalidad_id.required' => 'El campo Modalidad termino es obligatorio.',
            // VALIDACION DE TIPO CURSO
            'tipo_curso_id.required' => 'El campo Tipo termino es obligatorio.',
            // VALIDACION DE CATEGORIA CURSO
            'categoria_id.required' => 'El campo Categoria termino es obligatorio.',

        ];
    }
}
