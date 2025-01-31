<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cidades = [
            ['nome' => 'Pelotas', 'estado' => 'RS'],
            ['nome' => 'São Paulo', 'estado' => 'SP'],
            ['nome' => 'Curitiba', 'estado' => 'PR']
        ];

        foreach ($cidades as $cidade) {
            Cidade::create($cidade);
        }
    }
}
