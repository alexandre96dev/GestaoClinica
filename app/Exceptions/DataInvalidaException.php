<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class DataInvalidaException extends HttpResponseException
{
    public function __construct($mensagem)
    {
        parent::__construct(response()->json([
            'mensagem' => $mensagem,
        ], 422));
    }
}
