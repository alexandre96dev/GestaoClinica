<?php
    namespace App\Domains\Cidade\Repository;

    use App\Domains\Cidade\Entity\Cidade;

    interface CidadeRepositoryInterface {
        public function listarTodasAsCidades(?string $nome): array;
    }