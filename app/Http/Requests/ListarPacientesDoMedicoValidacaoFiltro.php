<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ListarPacientesDoMedicoValidacaoFiltro extends FormRequest
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
            'apenas-agendadas' => 'nullable|boolean',
            'nome' => 'nullable|string|regex:/^[a-zA-Z\s]+$/',
            'id_medico' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.regex' => 'O campo nome deve conter apenas letras e espaços.',
            'nome.string' => 'O campo nome deve ser uma string',
            'apenas-agendadas.boolean' => 'O campo nome deve ser boolean',
            'id_medico.required' => 'O campo medico é obrigatório',
            'id_medico.integer' => 'O campo medico deve ser inteiro',
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

    public function validationData()
    {
        return array_merge($this->query->all(),  [
            'id_medico' => $this->route('id_medico'),
        ]);
    }
}
