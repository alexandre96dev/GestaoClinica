<?php

namespace App\Exceptions;
use Illuminate\Http\Exceptions\HttpResponseException;

class PacienteNaoEncontradoException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(response()->json([
            'mensagem' => 'Paciente não encontrado',
        ], 404));
    }
}
