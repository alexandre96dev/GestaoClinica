<?php 
    namespace App\Domains\Medico\Entity;

    class Medico {
        public ?int $id;
        public string $nome;
        public string $especialidade;
        public int $cidade_id;
        public ?string $created_at;
        public ?string $updated_at;
        public ?string $deleted_at;


        public function __construct(?int $id, string $nome, string $especialidade, int $cidade_id)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->especialidade = $especialidade;
            $this->cidade_id = $cidade_id;
        }

        public function getId(): int
        {
            return $this->id;
        }

        public function getNome(): string
        {
            return $this->nome;
        }

        public function getEspecialidade(): string
        {
            return $this->especialidade;
        }

        public function getCidadeId(): int
        {
            return $this->cidade_id;
        }

        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function setNome(string $nome): void
        {
            $this->nome = $nome;
        }

        public function setEspecialidade(string $especialidade): void
        {
            $this->especialidade = $especialidade;
        }

        public function setCidadeId(int $cidadeId): void
        {
            $this->cidade_id = $cidadeId;
        }

        public function getCreatedAt(): ?string
        {
            return $this->created_at;
        }

        public function getUpdatedAt(): ?string
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
    }
    