<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendarConsultaValidacaoFiltro extends FormRequest
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
            'medico_id' => 'required|integer',
            'paciente_id' => 'required|integer',
            'data' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'medico_id.required' => 'O campo medico_id é obrigatório.',
            'medico_id.integer' => 'O campo medico_id é deve ser inteiro.',
            'paciente_id.required' => 'O campo paciente_id é obrigatório',
            'paciente_id.integer' => 'O campo paciente_id deve ser inteiro',
            'data.required' => 'O campo data é obrigatório',
            'data.string' => 'O campo data deve ser uma string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'messagem' => 'Erro de validação',
            'erros' => $errors
        ], 422));
    }
}
