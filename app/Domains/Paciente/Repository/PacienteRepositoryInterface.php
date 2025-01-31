<?php
    namespace App\Domains\Paciente\Repository;

    use App\Domains\Paciente\Entity\Consulta;
    use App\Domains\Paciente\Entity\Paciente;

    interface PacienteRepositoryInterface {
        public function agendarConsulta(Consulta $consulta): Consulta;
        public function listarPacientesDoMedico(int $medicoId, ?bool $apenasAgendadas, ?string $nome): array;
        public function atualizarPaciente(Paciente $paciente): Paciente;
        public function listarPorId(int $pacienteId): ?Paciente;
        public function adicionarPaciente(Paciente $paciente): Paciente;
    }