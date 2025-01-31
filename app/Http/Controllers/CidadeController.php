<?php

namespace App\Http\Controllers;

use App\Domains\Cidade\UseCase\ListarCidades;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ListarCidadesValidacaoFiltro;


class CidadeController extends Controller {
    private ListarCidades $listarCidades;

    public function __construct(ListarCidades $listarCidades)
    {
        $this->listarCidades = $listarCidades;
    }

    public function listarCidades(ListarCidadesValidacaoFiltro $requisicaoValidada): JsonResponse
    {
        return $this->listarCidades->execute($requisicaoValidada);
    }
}
