<?php

namespace Tests\Unit;

use App\Infrastructure\Autenticacao\Persistence\Eloquent\AutenticacaoRepository;
use App\Models\User as UsuarioModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutenticacaoRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UsuarioModel::factory()->create(['email' => 'joao@example.com', 'password' => bcrypt('password123')]);
        UsuarioModel::factory()->create(['email' => 'maria@example.com', 'password' => bcrypt('password456')]);
    }

    public function testListarUsuarioPorEmailExistente()
    {
        $autenticacaoRepository = new AutenticacaoRepository();
        $usuario = $autenticacaoRepository->listarUsuarioPorEmail('joao@example.com');

        $this->assertNotNull($usuario);
        $this->assertEquals('joao@example.com', $usuario->getEmail());
    }

    public function testListarUsuarioPorEmailInexistente()
    {
        $autenticacaoRepository = new AutenticacaoRepository();
        $usuario = $autenticacaoRepository->listarUsuarioPorEmail('inexistente@example.com');

        $this->assertNull($usuario);
    }
}