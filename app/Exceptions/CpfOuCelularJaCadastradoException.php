<?php

namespace App\Exceptions;
use Illuminate\Http\Exceptions\HttpResponseException;

class CpfOuCelularJaCadastradoException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(response()->json([
            'mensagem' => 'CPF ou celular já cadastrado',
        ], 500));
    }
}
