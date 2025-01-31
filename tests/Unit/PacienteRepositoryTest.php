<?php

namespace Tests\Unit;

use App\Infrastructure\Paciente\Persistence\Eloquent\PacienteRepository;
use App\Models\Paciente as PacienteModel;
use App\Domains\Paciente\Entity\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Exceptions\HttpResponseException;

class PacienteRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        PacienteModel::factory()->create(['id'=> 1, 'nome' => 'João Silva', 'cpf' => '123.456.789-00', 'celular' => '(11) 98484-6362']);
        PacienteModel::factory()->create(['id'=> 2, 'nome' => 'Maria Souza', 'cpf' => '987.654.321-00', 'celular' => '(22) 98765-4321']);
    }

    public function testAdicionarPaciente()
    {
        $pacienteRepository = new PacienteRepository();
        $paciente = new Paciente(null, 'Ana Clara', '111.222.333-44', '(33) 99999-8888');

        $pacienteCadastrado = $pacienteRepository->adicionarPaciente($paciente);

        $this->assertNotNull($pacienteCadastrado->getId());
        $this->assertEquals('Ana Clara', $pacienteCadastrado->getNome());
        $this->assertEquals('111.222.333-44', $pacienteCadastrado->getCpf());
        $this->assertEquals('(33) 99999-8888', $pacienteCadastrado->getCelular());
    }

    public function testAdicionarPacienteComCpfDuplicado()
    {
        $this->expectException(HttpResponseException::class);

        $pacienteRepository = new PacienteRepository();
        $paciente = new Paciente(null, 'Ana Clara', '123.456.789-00', '(33) 99999-8888');

        $pacienteRepository->adicionarPaciente($paciente);
    }

    public function testAtualizarPaciente()
    {
        $pacienteRepository = new PacienteRepository();
        $paciente = new Paciente(1, 'João Silva', '123.456.789-00', '(11) 98484-6362');
        $paciente->setNome('João Silva Atualizado');
        $paciente->setCelular('(11) 99999-9999');

        $pacienteAtualizado = $pacienteRepository->atualizarPaciente($paciente);

        $this->assertEquals('João Silva Atualizado', $pacienteAtualizado->getNome());
        $this->assertEquals('(11) 99999-9999', $pacienteAtualizado->getCelular());
    }

    public function testAtualizarPacienteComCpfDuplicado()
    {
        $this->expectException(HttpResponseException::class);

        $pacienteRepository = new PacienteRepository();
        $paciente = new Paciente(2, 'João Silva', '987.654.321-00', '(11) 98484-6362');

        $pacienteRepository->atualizarPaciente($paciente);
    }
}