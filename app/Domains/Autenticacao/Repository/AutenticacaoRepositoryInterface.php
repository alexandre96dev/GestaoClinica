<?php
    namespace App\Domains\Autenticacao\Repository;

use App\Domains\Autenticacao\Entity\Usuario;

    interface AutenticacaoRepositoryInterface {
        public function listarUsuarioPorEmail(string $email): ?Usuario;
    }