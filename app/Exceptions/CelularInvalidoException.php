<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class CelularInvalidoException extends HttpResponseException
{
    public function __construct()
    {
        parent::__construct(response()->json([
            'mensagem' => 'Formato do celular inválido',
        ], 422));
    }
}
