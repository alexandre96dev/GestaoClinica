<?php 
    namespace App\Domains\Medico\UseCase;

    use App\Domains\Medico\Repository\MedicoRepositoryInterface;
    use App\Http\Requests\ListarMedicosValidacaoFiltro;
    use Illuminate\Http\JsonResponse;

    class ListarMedicos {
        private MedicoRepositoryInterface $medicoRepository;
    
        public function __construct(MedicoRepositoryInterface $medicoRepository)
        {
            $this->medicoRepository = $medicoRepository;
        }
    
        public function execute(ListarMedicosValidacaoFiltro $requisicaoValidada): JsonResponse
        {
            $nome = $requisicaoValidada->input('nome', '');

            $medicosEncontrados = $this->medicoRepository->listarTodosMedicos($nome);

            return response()->json($medicosEncontrados);
        }
    }
    