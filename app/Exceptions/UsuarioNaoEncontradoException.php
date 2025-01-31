<?php

namespace App\Exceptions;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsuarioNaoEncontradoException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(response()->json([
            'mensagem' => 'Usuário não encontrado',
        ], 404));
    }
}
