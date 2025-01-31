<?php

namespace App\Domains\Autenticacao\UseCase;

use App\Exceptions\PacienteNaoEncontradoException;
use App\Exceptions\TokenInvalidoOuExpiradoException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class InformacoesDoUsuario
{
    public function execute(): JsonResponse
    {
        try {
            $usuario = JWTAuth::parseToken()->authenticate();

            if (!$usuario) {
               throw new PacienteNaoEncontradoException();
            }
            
            return response()->json([
                'id' => $usuario->id,
                'email' => $usuario->email,
                'nome' => $usuario->name,
            ], 200);
        } catch (\Exception $e) {
            throw new TokenInvalidoOuExpiradoException();
        }
    }
}