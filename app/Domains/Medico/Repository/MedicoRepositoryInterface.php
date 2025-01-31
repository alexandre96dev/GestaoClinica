<?php 
    namespace App\Domains\Medico\Repository;

    use App\Domains\Medico\Entity\Medico;

    interface MedicoRepositoryInterface {
        public function listarTodosMedicos(?string $nome): array;
        public function listarMedicosDeUmaCidade(int $id_cidade, ?string $nome): array;
        public function cadastrarNovoMedico(Medico $medico): Medico;
    }