<?php

namespace App\Domains\Autenticacao\Entity;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class Usuario
{
    private ?int $id;
    private string $email;
    private string $senha;

    public function __construct(?int $id, string $email, string $senha)
    {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function hashSenha(): void
    {
        $this->senha = Hash::make($this->senha);
    }

    public function verificarSenha(string $senha): bool {
        return Hash::check($senha, $this->senha);
    }

    public function gerarToken(): string
    {
        $usuarioJWTSubject = new UsuarioJWTSubject($this);
        return JWTAuth::fromUser($usuarioJWTSubject);
    }
}