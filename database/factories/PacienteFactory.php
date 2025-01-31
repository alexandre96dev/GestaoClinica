<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    protected $model = Paciente::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'cpf' => $this->faker->regexify('[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}'),
            'celular' => $this->faker->phoneNumber,
        ];
    }
}