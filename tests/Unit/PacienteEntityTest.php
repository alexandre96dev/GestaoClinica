<?php

namespace Tests\Unit;

use App\Domains\Paciente\Entity\Paciente;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\Exceptions\HttpResponseException;


class PacienteEntityTest extends TestCase
{
    public function testeCriacaoObjetoPaciente()
    {
        $paciente = new Paciente(1, 'João Silva', '123.456.789-00', '(11) 98484-6362');
        $paciente->setCreatedAt('2023-01-01 00:00:00');
        $paciente->setUpdatedAt('2023-01-02 00:00:00');
        $paciente->setDeletedAt(null);

        $this->assertEquals(1, $paciente->getId());
        $this->assertEquals('João Silva', $paciente->getNome());
        $this->assertEquals('123.456.789-00', $paciente->getCpf());
        $this->assertEquals('(11) 98484-6362', $paciente->getCelular());
    }
}
