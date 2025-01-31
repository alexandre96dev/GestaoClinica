<?php
    namespace App\Domains\Cidade\Entity;
    class Cidade {
        public int $id;
        public string $nome;
        public string $estado;

        public function __construct(int $id, string $nome, string $estado) {
            $this->id = $id;
            $this->nome = $nome;
            $this->estado = $estado;
        }

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getEstado() {
            return $this->estado;
        }
    }