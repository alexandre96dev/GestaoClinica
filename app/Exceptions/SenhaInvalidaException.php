<?php

namespace App\Exceptions;
use Illuminate\Http\Exceptions\HttpResponseException;

class SenhaInvalidaException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(response()->json([
            'mensagem' => 'Senha inválida',
        ], 422));
    }
}
