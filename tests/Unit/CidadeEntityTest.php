<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Domains\Cidade\Entity\Cidade;

class CidadeEntityTest extends TestCase
{
    public function testeCriacaoObjetoCidade(): void
    {
        $cidade = new Cidade(1, 'São Paulo', 'SP');
        $this->assertInstanceOf(Cidade::class, $cidade);
        $this->assertEquals(1, $cidade->getId());
        $this->assertEquals('São Paulo', $cidade->getNome());
        $this->assertEquals('SP', $cidade->getEstado());
    }
}