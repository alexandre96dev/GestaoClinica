<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdicionarPacienteValidacaoFiltro extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    private const STRING_REQUERIDA = 'required|string';

    public function rules(): array
    {
        return [
            'nome' => self::STRING_REQUERIDA,
            'cpf' => self::STRING_REQUERIDA,
            'celular' => self::STRING_REQUERIDA
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome é deve ser uma string.',
            'cpf.required' => 'O campo cpf é obrigatório',
            'cpf.string' => 'O campo cpf deve ser uma string',
            'celular.required' => 'O campo celular é obrigatório',
            'celular.string' => 'O campo celular deve ser uma string',
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
