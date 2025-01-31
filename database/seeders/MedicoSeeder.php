<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medico;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicos = [
            ['id' => 6, 'nome' => 'Aurora Delgado', 'especialidade' => 'Dermatologia', 'cidade_id' => 2],
            ['id' => 2, 'nome' => 'Cristina Ariane Grego', 'especialidade' => 'Neurologia', 'cidade_id' => 1],
            ['id' => 13, 'nome' => 'Dayana Mônica Paz', 'especialidade' => 'Oftalmologia', 'cidade_id' => 3],
            ['id' => 3, 'nome' => 'Dener Allan Verdugo Jr.', 'especialidade' => 'Dermatologia', 'cidade_id' => 1],
            ['id' => 8, 'nome' => 'Dr. Milene Cristiana Ortiz Sobrinho', 'especialidade' => 'Neurologia', 'cidade_id' => 3],
            ['id' => 14, 'nome' => 'Dr. Renan Fidalgo Domingues', 'especialidade' => 'Neurologia', 'cidade_id' => 2],
            ['id' => 15, 'nome' => 'Juliana Léia Neves Jr.', 'especialidade' => 'Dermatologia', 'cidade_id' => 3],
            ['id' => 7, 'nome' => 'Juliane Ortega', 'especialidade' => 'Oftalmologia', 'cidade_id' => 3],
            ['id' => 1, 'nome' => 'Maiara Heloísa Benites Sobrinho', 'especialidade' => 'Oftalmologia', 'cidade_id' => 1],
            ['id' => 9, 'nome' => 'Malu Malena Lozano', 'especialidade' => 'Dermatologia', 'cidade_id' => 3],
            ['id' => 5, 'nome' => 'Nayara Carvalho Neto', 'especialidade' => 'Neurologia', 'cidade_id' => 2],
            ['id' => 10, 'nome' => 'Otávio Yuri Delatorre', 'especialidade' => 'Oftalmologia', 'cidade_id' => 3],
            ['id' => 11, 'nome' => 'Srta. Antonieta Daniella de Aguiar Filho', 'especialidade' => 'Neurologia', 'cidade_id' => 1],
            ['id' => 4, 'nome' => 'Srta. Kelly Tatiane de Arruda', 'especialidade' => 'Oftalmologia', 'cidade_id' => 2],
            ['id' => 12, 'nome' => 'Srta. Mariana Saraiva Sanches', 'especialidade' => 'Dermatologia', 'cidade_id' => 1],
        ];

        foreach ($medicos as $medico) {
            Medico::create($medico);
        }
    }
}
