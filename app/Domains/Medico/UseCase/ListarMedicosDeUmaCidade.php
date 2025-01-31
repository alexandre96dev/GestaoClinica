<?php 
    namespace App\Domains\Medico\UseCase;

    use App\Domains\Medico\Repository\MedicoRepositoryInterface;
    use App\Http\Requests\ListarMedicosDeUmaCidadeValidacaoFiltro;
    use Illuminate\Http\JsonResponse;

    class ListarMedicosDeUmaCidade {
        private MedicoRepositoryInterface $medicoRepository;
    
        public function __construct(MedicoRepositoryInterface $medicoRepository)
        {
            $this->medicoRepository = $medicoRepository;
        }
    
        public function execute(ListarMedicosDeUmaCidadeValidacaoFiltro $requisicaoValidada): JsonResponse
        {
            $dadosValidados = $requisicaoValidada->validated();

            $cidadeId = $dadosValidados['id_cidade'];

            $nome = $dadosValidados['nome'] ?? null;

            return response()->json($this->medicoRepository->listarMedicosDeUmaCidade($cidadeId, $nome));
        }
    }
    