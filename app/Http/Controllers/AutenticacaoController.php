<?php

namespace App\Http\Controllers;

use App\Domains\Autenticacao\UseCase\InformacoesDoUsuario;
use App\Domains\Autenticacao\UseCase\Login;
use App\Http\Requests\LoginValidacaoFiltro;
use Illuminate\Http\Request;

class AutenticacaoController extends Controller
{
    private Login $login;
    private InformacoesDoUsuario $informacoesDoUsuario;

    public function __construct(Login $login, InformacoesDoUsuario $informacoesDoUsuario)
    {
        $this->login = $login;
        $this->informacoesDoUsuario = $informacoesDoUsuario;
    }

    public function login(LoginValidacaoFiltro $requisicaoValidada){
        return $this->login->execute($requisicaoValidada);
    }

    public function informacoesDoUsuario(){
        return $this->informacoesDoUsuario->execute();
    }
}
