<?php 
    namespace App\Domains\Autenticacao\UseCase;

    use App\Domains\Autenticacao\Repository\AutenticacaoRepositoryInterface;
use App\Exceptions\SenhaInvalidaException;
use App\Exceptions\UsuarioNaoEncontradoException;
use App\Http\Requests\LoginValidacaoFiltro;
    use Illuminate\Http\Exceptions\HttpResponseException;
    use Illuminate\Support\Facades\Auth;

    class Login {
        private AutenticacaoRepositoryInterface $autenticacaoRepository;
    
        public function __construct(AutenticacaoRepositoryInterface $autenticacaoRepository)
        {
            $this->autenticacaoRepository = $autenticacaoRepository;
        }
    
        public function execute(LoginValidacaoFiltro $requisicaoValidadae)
        {
            $dadosValidados = $requisicaoValidadae->validated();

            $email = $dadosValidados['email'];

            $senha = $dadosValidados['password'];

            $usuarioEncontrado = $this->autenticacaoRepository->listarUsuarioPorEmail($email);

            if (!$usuarioEncontrado) {
                throw new UsuarioNaoEncontradoException();
            }

            if (!$usuarioEncontrado->verificarSenha($senha)) {
                throw new SenhaInvalidaException();
            }
            
            return response()->json([
                'token' => $usuarioEncontrado->gerarToken()
            ]);
        }
    }