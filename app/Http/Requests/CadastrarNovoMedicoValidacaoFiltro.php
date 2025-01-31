<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CadastrarNovoMedicoValidacaoFiltro extends FormRequest
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
            'nome' => 'required|string|max:255',
            'especialidade' => 'required|string|max:255',
            'cidade_id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome é deve ser uma string.',
            'especialidade.required' => 'O campo especialidade é obrigatório',
            'especialidade.string' => 'O campo especialidade deve ser uma string',
            'cidade_id.required' => 'O campo cidade_id é obrigatório',
            'cidade_id.integer' => 'O campo cidade_id deve ser inteiro',
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
