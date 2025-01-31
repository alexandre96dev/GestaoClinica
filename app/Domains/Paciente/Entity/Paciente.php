<?php
    namespace App\Domains\Paciente\Entity;

use App\Exceptions\CelularInvalidoException;
use App\Exceptions\CpfInvalidoException;
use Illuminate\Http\Exceptions\HttpResponseException;
    
        class Paciente {
        public ?int $id;
        public string $nome;
        public string $cpf;
        public string $celular;
        public string $created_at;
        public string $updated_at;
        public ?string $deleted_at;
        public ?Consulta $consulta;

        public function __construct(?int $id, string $nome, string $cpf, string $celular) {
            $this->id = $id;
            $this->nome = $nome;
            if (!$this->validarFormatoCpf($cpf)) {
                throw new CpfInvalidoException('Formato do CPF inválido');
            }

            $this->cpf = $cpf;

            if (!$this->validarFormatoCelular($celular)) {
                throw new CelularInvalidoException();
            }

            $this->celular = $celular;
        }

        public function getId(): string {
            return $this->id;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setNome(string $nome): void {
            $this->nome = $nome;
        }

        public function getNome(): string {
            return $this->nome;
        }

        public function getCelular(): string{
            return $this->celular;
        }

        public function getCpf(): string {
            return $this->cpf;
        }

        public function setCpf(string $cpf): void {
            $this->cpf = $cpf;
        }

        public function setCelular(string $celular): void {
            if (!$this->validarFormatoCelular($celular)) {
                throw new CpfInvalidoException();
            }
            $this->celular = $celular;
        }

        public function agendarConsulta(Consulta $consulta): void {
            $this->consulta = $consulta;
        }

        public function setCreatedAt(string $createdAt): void {
            $this->created_at = $createdAt;
        }

        public function setUpdatedAt(string $updatedAt): void {
            $this->updated_at = $updatedAt;
        }

        public function setDeletedAt(?string $deletedAt): void {
            $this->deleted_at = $deletedAt;
        }

        public function validarFormatoCelular(string $celular): bool
        {
            return preg_match('/^\(\d{2}\) \d{5}\-\d{4}$/', $celular) === 1;
        }

        private function validarFormatoCpf(string $cpf): bool
        {
            return preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $cpf) === 1;
        }
    }