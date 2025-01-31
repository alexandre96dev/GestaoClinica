<?php

namespace Tests\Unit;

use App\Domains\Medico\Entity\Medico;
use PHPUnit\Framework\TestCase;

class MedicoEntityTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testeCriacaoObjetoCidade(): void
    {
        $medico = new Medico(1, 'Dr. João', 'Cardiologia', 1);
        $medico->setCreatedAt('2023-01-01 00:00:00');
        $medico->setUpdatedAt('2023-01-02 00:00:00');
        $medico->setDeletedAt(null);

        $this->assertInstanceOf(Medico::class, $medico);
        $this->assertEquals(1, $medico->getId());
        $this->assertEquals('Dr. João', $medico->getNome());
        $this->assertEquals('Cardiologia', $medico->getEspecialidade());
        $this->assertEquals('2023-01-01 00:00:00', $medico->getCreatedAt());
        $this->assertEquals('2023-01-02 00:00:00', $medico->getUpdatedAt());
        $this->assertEquals(null, $medico->getDeletedAt());
    }
}
