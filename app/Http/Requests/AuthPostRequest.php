<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'n_matricula' => 'required|numeric|min:4',
            'password' => 'required|min:4',
        ];
    }
    /**
     * Get the custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'n_matricula.required' => 'O Nº de Matrícula é obrigatória.',
            'n_matricula.numeric' => 'O Nº de Matrícula deve conter somente números.',
            'n_matricula.min' => 'O Nº de Matrícula deve conter 14 caracteres.',
            'password.required' => 'A senha é obrigatória.',
            'password' => 'A senha deve ter pelo menos 4 caracteres.',
        ];
    }
}
