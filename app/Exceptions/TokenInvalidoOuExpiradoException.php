<?php

namespace App\Exceptions;
use Illuminate\Http\Exceptions\HttpResponseException;

class TokenInvalidoOuExpiradoException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(response()->json([
            'mensagem' => 'Token inválido ou expirado',
        ], 401));
    }
}
