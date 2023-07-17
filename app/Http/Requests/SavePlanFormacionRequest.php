<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SavePlanFormacionRequest extends FormRequest
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
            'trabajos' => 'required | array',
            'cursos' => 'required | array',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('error', 'trabajos y cursos son obligatorios')
        );
    }
}
