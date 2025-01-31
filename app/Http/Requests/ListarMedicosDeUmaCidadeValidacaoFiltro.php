<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ListarMedicosDeUmaCidadeValidacaoFiltro extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_cidade' => 'required|integer',
            'nome' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/'
        ];
    }

    public function messages(): array
    {
        return [
            'id_cidade.required' => 'O campo id_cidade é obrigatório.',
            'id_cidade.integer' => 'O campo id_cidade deve ser um número inteiro.',
            'nome.regex' => 'O campo nome deve conter apenas letras e espaços.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->query->all(),  [
            'id_cidade' => $this->route('id_cidade'),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'mensagem' => 'Erro de validação',
            'erros' => $validator->errors(),
        ], 422));
    }
}
