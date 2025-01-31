<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class CpfInvalidoException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(response()->json([
            'mensagem' => 'Formato do CPF inválido',
        ], 422));
    }
}
