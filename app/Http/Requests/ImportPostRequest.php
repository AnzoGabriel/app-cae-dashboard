<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportPostRequest extends FormRequest
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
            'relatorio-ir' => 'required|mimes:xls|max:2048',
            'relatorio-faltas' => 'required|mimes:xls|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'relatorio-ir.required' => 'Adicione o relatório.',
            'relatorio-ir.mimes' => 'O arquivo deve estar no formato XLS.',
            'relatorio-faltas.required' => 'Adicione o relatório.',
            'relatorio-faltas.mimes' => 'O arquivo deve estar no formato XLS.',
        ];
    }
}
