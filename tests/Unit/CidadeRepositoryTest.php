<?php

namespace Tests\Unit;

use App\Infrastructure\Cidade\Persistence\Eloquent\CidadeRepository;
use App\Models\Cidade as CidadeModel;
use App\Domains\Cidade\Entity\Cidade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CidadeRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CidadeModel::factory()->create(['nome' => 'São Paulo', 'estado' => 'SP']);
        CidadeModel::factory()->create(['nome' => 'Rio de Janeiro', 'estado' => 'RJ']);
    }

    public function testListarTodasAsCidadesSemFiltro()
    {

        $cidadeRepository = new CidadeRepository();
        $cidades = $cidadeRepository->listarTodasAsCidades(null);

        $this->assertCount(2, $cidades);

        $this->assertEquals('Rio de Janeiro', $cidades[0]->nome);
        $this->assertEquals('São Paulo', $cidades[1]->nome);
    }

    public function testListarTodasAsCidadesComFiltro()
    {

        $cidadeRepository = new CidadeRepository();
        $cidades = $cidadeRepository->listarTodasAsCidades('São');

        $this->assertCount(1, $cidades);
        $this->assertEquals('São Paulo', $cidades[0]->getNome());
    }
}