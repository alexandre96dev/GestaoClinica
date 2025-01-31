<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacientes = [
            ['nome' => 'João Silva', 'cpf' => '123.456.789-00', 'celular' => '(11) 91234-5678'],
            ['nome' => 'Maria Oliveira', 'cpf' => '987.654.321-00', 'celular' => '(21) 99876-5432'],
            ['nome' => 'Carlos Souza', 'cpf' => '456.789.123-00', 'celular' => '(31) 93456-7890'],
            ['nome' => 'Ana Pereira', 'cpf' => '321.654.987-00', 'celular' => '(41) 97654-3210'],
            ['nome' => 'Paulo Santos', 'cpf' => '789.123.456-00', 'celular' => '(51) 91234-0987'],
        ];

        foreach ($pacientes as $paciente) { 
            Paciente::create($paciente);
        }
    }
}
