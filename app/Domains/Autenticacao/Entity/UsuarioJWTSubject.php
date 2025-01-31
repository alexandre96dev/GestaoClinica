<?php

namespace App\Domains\Autenticacao\Entity;

use Tymon\JWTAuth\Contracts\JWTSubject;

class UsuarioJWTSubject implements JWTSubject
{
    private Usuario $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function getJWTIdentifier()
    {
        return $this->usuario->getId();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }
}