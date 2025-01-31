<?php

namespace Tests\Unit;

use App\Domains\Paciente\Entity\Consulta;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\Exceptions\HttpResponseException;
use DateTime;

class ConsultaEntityTest extends TestCase
{
    private DateTime $dataTesteValidacao;
    

    protected function setUp(): void
    {
        parent::setUp();
    }
    public function testeCriacaoObjetoConsulta()
    {
        $consulta = new Consulta(1, 1, 1, '2025-10-12 09:00:00');
        $this->assertEquals(1, $consulta->getId());
        $this->assertEquals(1, $consulta->getMedicoId());
        $this->assertEquals(1, $consulta->getPacienteId());
        $this->assertEquals('2025-10-12 09:00:00', $consulta->getData());
    }

    public function testeAlterarId()
    {
        $consulta = new Consulta(1, 1, 1,'2025-10-12 09:00:00');
        $consulta->setId(2);
        $this->assertEquals(2, $consulta->getId());
    }

    public function testeAlterarMedicoId()
    {
        $consulta = new Consulta(1, 1, 1, '2025-10-12 09:00:00');
        $consulta->setMedicoId(2);
        $this->assertEquals(2, $consulta->getMedicoId());
    }

    public function testeAlterarPacienteId()
    {
        $consulta = new Consulta(1, 1, 1, '2025-10-12 09:00:00');
        $consulta->setPacienteId(2);
        $this->assertEquals(2, $consulta->getPacienteId());
    }
}
