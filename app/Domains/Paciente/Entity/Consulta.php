<?php 
    namespace App\Domains\Paciente\Entity;

use App\Exceptions\DataInvalidaException;
use Illuminate\Http\Exceptions\HttpResponseException;
    use DateTime;
    
    class Consulta {
        public ?int $id;
        public int $medico_id;
        public int $paciente_id;
        public string $data;
        public string $created_at;
        public string $updated_at;
        public ?string $deleted_at;

        public function __construct(?int $id, int $medicoId, int $pacienteId, string $data)
        {
            $this->id = $id;
            $this->medico_id = $medicoId;
            $this->paciente_id = $pacienteId;
            $this->data = $data;

            if($this->verificaFormatoDataDeConsulta()){
                throw new DataInvalidaException('Formato de data inválido');
            }

            if($this->verificaDataFutura()){
                throw new DataInvalidaException('A data da consulta deve ser maior que a data atual');
            }
        }

        public function getId(): int
        {
            return $this->id;
        }

        public function getMedicoId(): int
        {
            return $this->medico_id;
        }

        public function getPacienteId(): int
        {
            return $this->paciente_id;
        }

        public function getData(): string
        {
            return $this->data;
        }

        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setMedicoId(int $medicoId): void
        {
            $this->medico_id = $medicoId;
        }

        public function setPacienteId(int $pacienteId): void
        {
            $this->paciente_id = $pacienteId;
        }


        public function getCreatedAt(): string
        {
            return $this->created_at;
        }

        public function getUpdatedAt(): string
        {
            return $this->updated_at;
        }

        public function getDeletedAt(): ?string
        {
            return $this->deleted_at;
        }

        public function setCreatedAt(string $createdAt): void
        {
            $this->created_at = $createdAt;
        }

        public function setUpdatedAt(string $updatedAt): void
        {
            $this->updated_at = $updatedAt;
        }

        public function setDeletedAt(?string $deletedAt): void
        {
            $this->deleted_at = $deletedAt;
        }

        private function verificaFormatoDataDeConsulta(): bool
        {
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->data);
            return !$dateTime || $dateTime->format('Y-m-d H:i:s') !== $this->data;
        }

        public function verificaDataFutura(): bool
        {
            $dataConsulta = new DateTime($this->data);
            $dataAtual = new DateTime();
    
            return $dataConsulta <= $dataAtual;
        }
    }
    