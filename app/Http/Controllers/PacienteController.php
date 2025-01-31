<?php

namespace App\Http\Controllers;

use App\Domains\Paciente\UseCase\AdicionarPaciente;
use App\Domains\Paciente\UseCase\AgendarConsulta;
use App\Domains\Paciente\UseCase\AtualizarPaciente;
use App\Domains\Paciente\UseCase\ListarPacientesDeUmMedico;
use App\Http\Requests\AdicionarPacienteValidacaoFiltro;
use App\Http\Requests\AgendarConsultaValidacaoFiltro;
use App\Http\Requests\AtualizarPacienteValidacaoFiltro;
use App\Http\Requests\ListarPacientesDoMedicoValidacaoFiltro;
use Illuminate\Http\JsonResponse;

class PacienteController extends Controller
{
    private AgendarConsulta $agendarConsulta;
    private ListarPacientesDeUmMedico $listarPacientesDeUmMedico;
    private AtualizarPaciente $atualizarPaciente;
    private AdicionarPaciente $adicionarPaciente;

    public function __construct(AgendarConsulta $agendarConsulta, ListarPacientesDeUmMedico $listarPacientesDeUmMedico, AtualizarPaciente $atualizarPaciente, AdicionarPaciente $adicionarPaciente)
    {
        $this->agendarConsulta = $agendarConsulta;
        $this->listarPacientesDeUmMedico = $listarPacientesDeUmMedico;
        $this->atualizarPaciente = $atualizarPaciente;
        $this->adicionarPaciente = $adicionarPaciente;
    }

    public function agendarConsulta(AgendarConsultaValidacaoFiltro $requisicaoValidada): JsonResponse{
        return $this->agendarConsulta->execute($requisicaoValidada);
    }

    public function listarPacientesDoMedico(ListarPacientesDoMedicoValidacaoFiltro $requisicaoValidada): JsonResponse{
        return $this->listarPacientesDeUmMedico->execute($requisicaoValidada);
    }

    public function atualizarPaciente(AtualizarPacienteValidacaoFiltro $requisicaoValidada): JsonResponse{
        return $this->atualizarPaciente->execute($requisicaoValidada);
    }

    public function adicionarPaciente(AdicionarPacienteValidacaoFiltro $request): JsonResponse{
        return $this->adicionarPaciente->execute($request);
    }
}
