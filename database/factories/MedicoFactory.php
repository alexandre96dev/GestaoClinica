<?php

namespace Database\Factories;

use App\Models\Medico;
use App\Models\Cidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicoFactory extends Factory
{
    protected $model = Medico::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'especialidade' => $this->faker->word,
            'cidade_id' => Cidade::factory(),
        ];
    }
}