<?php 
    namespace App\Domains\Medico\UseCase;

    use App\Domains\Medico\Entity\Medico;
    use App\Domains\Medico\Repository\MedicoRepositoryInterface;
    use App\Http\Requests\CadastrarNovoMedicoValidacaoFiltro;
    use Illuminate\Http\JsonResponse;

    class CadastrarNovoMedico {
        private MedicoRepositoryInterface $medicoRepository;
    
        public function __construct(MedicoRepositoryInterface $medicoRepository)
        {
            $this->medicoRepository = $medicoRepository;
        }
    
        public function execute(CadastrarNovoMedicoValidacaoFiltro $requisicaoValidada): JsonResponse
        {
            $dadosValidados = $requisicaoValidada->validated();

            $medico = new Medico(null, $dadosValidados['nome'], $dadosValidados['especialidade'], $dadosValidados['cidade_id']);

            return response()->json($this->medicoRepository->cadastrarNovoMedico($medico));
        }
    }