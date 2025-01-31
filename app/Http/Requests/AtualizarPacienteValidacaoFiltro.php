<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AtualizarPacienteValidacaoFiltro extends FormRequest
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
            'nome' => 'required|string',
            'celular' => 'required|string',
            'id_paciente' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'celular.required' => 'O campo celular é obrigatório.',
            'celular.string' => 'O campo celular deve ser uma string.',
            'id_paciente.required' => 'O parametro id_paciente é obrigatório',
            'id_paciente.integer' => 'O parametro id_paciente deve ser inteiro'
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
        return array_merge($this->request->all(), [
            'id_paciente' => $this->route('id_paciente'),
        ]);
    }
}
