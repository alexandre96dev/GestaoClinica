<?php
    namespace App\Domains\Cidade\UseCase;

    use App\Domains\Cidade\Repository\CidadeRepositoryInterface;
    use App\Http\Requests\ListarCidadesValidacaoFiltro;
    use Illuminate\Http\JsonResponse;

    class ListarCidades
    {
        private CidadeRepositoryInterface $cidadeRepository;
    
        public function __construct(CidadeRepositoryInterface $cidadeRepository)
        {
            $this->cidadeRepository = $cidadeRepository;
        }
    
        public function execute(ListarCidadesValidacaoFiltro $requisicaoValidada): JsonResponse
        {
            $nome = $requisicaoValidada->input('nome', '');

            $cidadesEncontradas = $this->cidadeRepository->ListarTodasAsCidades($nome);

            return response()->json($cidadesEncontradas);
        }
    }