<?php

namespace Tests\Unit;

use App\Infrastructure\Medico\Persistence\Eloquent\MedicoRepository;
use App\Models\Medico as MedicoModel;
use App\Models\Cidade as CidadeModel;
use App\Domains\Medico\Entity\Medico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicoRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $cidade1 = CidadeModel::factory()->create(['id' => 0, 'nome' => 'Cidade 1', 'estado' => 'SP']);
        $cidade2 = CidadeModel::factory()->create(['id' => 1, 'nome' => 'Cidade 2', 'estado' => 'RJ']);

        MedicoModel::factory()->create(['nome' => 'Dr. João', 'especialidade' => 'Cardiologia', 'cidade_id' => $cidade1->id]);
        MedicoModel::factory()->create(['nome' => 'Dr. Maria', 'especialidade' => 'Pediatria', 'cidade_id' => $cidade1->id]);
        MedicoModel::factory()->create(['nome' => 'Dr. Pedro', 'especialidade' => 'Dermatologia', 'cidade_id' => $cidade2->id]);
    }

    public function testListarMedicosDeUmaCidadeSemFiltro()
    {
        $medicoRepository = new MedicoRepository();
        $medicos = $medicoRepository->listarMedicosDeUmaCidade(1, null);
        $this->assertCount(1, $medicos);
        $this->assertEquals('Dr. Pedro', $medicos[0]->getNome());
    }

    public function testListarMedicosDeUmaCidadeComFiltro()
    {
        $medicoRepository = new MedicoRepository();
        $medicos = $medicoRepository->listarMedicosDeUmaCidade(1, 'Dr');
        $this->assertCount(1, $medicos);
        $this->assertEquals('Dr. Pedro', $medicos[0]->getNome());
    }

    public function testListarMedicosDeUmaCidadeComFiltroInexistente()
    {
        $medicoRepository = new MedicoRepository();
        $medicos = $medicoRepository->listarMedicosDeUmaCidade(1, 'Inexistente');

        $this->assertCount(0, $medicos);
    }

    public function testCadastrarNovoMedico()
    {
        $medicoRepository = new MedicoRepository();
        $medico = new Medico(null, 'Dr. Ana', 'Neurologia', 1);

        $medicoCadastrado = $medicoRepository->cadastrarNovoMedico($medico);

        $this->assertNotNull($medicoCadastrado->getId());
        $this->assertEquals('Dr. Ana', $medicoCadastrado->getNome());
        $this->assertEquals('Neurologia', $medicoCadastrado->getEspecialidade());
        $this->assertEquals(1, $medicoCadastrado->getCidadeId());
    }
}