<?php

namespace App\Http\Controllers;

use App\Domains\Medico\UseCase\CadastrarNovoMedico;
use App\Http\Requests\ListarMedicosValidacaoFiltro;
use App\Domains\Medico\UseCase\ListarMedicos;
use App\Domains\Medico\UseCase\ListarMedicosDeUmaCidade;
use App\Http\Requests\CadastrarNovoMedicoValidacaoFiltro;
use App\Http\Requests\ListarMedicosDeUmaCidadeValidacaoFiltro;
use Illuminate\Http\JsonResponse;

class MedicoController extends Controller
{
    private ListarMedicos $listarMedicos;
    private ListarMedicosDeUmaCidade $listarMedicosDeUmaCidade;
    private CadastrarNovoMedico $cadastrarNovoMedico;
    
    public function __construct(ListarMedicos $listarMedicos, ListarMedicosDeUmaCidade $listarMedicosDeUmaCidade, CadastrarNovoMedico $cadastrarNovoMedico)
    {
        $this->listarMedicos = $listarMedicos;
        $this->listarMedicosDeUmaCidade = $listarMedicosDeUmaCidade;
        $this->cadastrarNovoMedico = $cadastrarNovoMedico;
    }

    public function listarMedicos(ListarMedicosValidacaoFiltro $requisicaoValidada): JsonResponse
    {
        return $this->listarMedicos->execute($requisicaoValidada);
    }

    public function listarMedicosDeUmaCidade(ListarMedicosDeUmaCidadeValidacaoFiltro $requisicaoValidada){
        return $this->listarMedicosDeUmaCidade->execute($requisicaoValidada);
    }

    public function cadastrarNovoMedico(CadastrarNovoMedicoValidacaoFiltro $requisicaoValidada){
        return $this->cadastrarNovoMedico->execute($requisicaoValidada);
    }
}
