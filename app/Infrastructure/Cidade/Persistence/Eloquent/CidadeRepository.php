<?php
    namespace App\Infrastructure\Cidade\Persistence\Eloquent;

    use App\Domains\Cidade\Entity\Cidade;
    use App\Domains\Cidade\Repository\CidadeRepositoryInterface;
    use App\Models\Cidade as CidadeModel;
    
    class CidadeRepository implements CidadeRepositoryInterface
    {
        public function listarTodasAsCidades(?string $nome): array
        {
            $query = CidadeModel::query();
            
            if (!empty($nome)) {
                $query->where('nome', 'like', '%' . $nome . '%');
            }

            $cidadeModels = $query->orderBy('nome', 'asc')->get();

            return $cidadeModels->map(function (CidadeModel $cidadeModel) {
                return new Cidade(
                    $cidadeModel->id,
                    $cidadeModel->nome,
                    $cidadeModel->estado
                );
            })->toArray();
        }
    }