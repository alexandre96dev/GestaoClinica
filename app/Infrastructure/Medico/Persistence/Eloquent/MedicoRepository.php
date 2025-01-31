<?php
    namespace App\Infrastructure\Medico\Persistence\Eloquent;

    use App\Domains\Medico\Entity\Medico;
    use App\Domains\Medico\Repository\MedicoRepositoryInterface;
    use App\Models\Medico as MedicoModel;
    
    class MedicoRepository implements MedicoRepositoryInterface
    {
        public function listarTodosMedicos(?string $nome): array
        {
            $query = MedicoModel::query();
            
            if (!empty($nome)) {
                $query->where('nome', 'like', '%' . $nome . '%');
            }

            $medicosEncontrados = $query->orderBy('nome', 'asc')->get();

            return $medicosEncontrados->map(function (MedicoModel $medicoModel) {
                return new Medico(
                    $medicoModel->id,
                    $medicoModel->nome,
                    $medicoModel->especialidade,
                    $medicoModel->cidade_id,
                );
            })->toArray();
        }

        public function listarMedicosDeUmaCidade(int $id_cidade, ?string $nome): array {
            $query = MedicoModel::query();
            
            if (!empty($nome)) {
                $query->where('nome', 'like', '%' . $nome . '%');
            }

            $query->where('cidade_id', '=', $id_cidade);

            $medicosPorCidade = $query->orderBy('nome', 'asc')->get();

            return $medicosPorCidade->map(function (MedicoModel $medicoModel) {
                return new Medico(
                    $medicoModel->id,
                    $medicoModel->nome,
                    $medicoModel->especialidade,
                    $medicoModel->cidade_id
                );
            })->toArray();
        }

        public function cadastrarNovoMedico(Medico $medico): Medico
        {
            $medicoModel = new MedicoModel();
            $medicoModel->nome = $medico->getNome();
            $medicoModel->especialidade = $medico->getEspecialidade();
            $medicoModel->cidade_id = $medico->getCidadeId();
            $medicoModel->save();

            $medico->setId($medicoModel->id);
            $medico->setCreatedAt($medicoModel->created_at);
            $medico->setUpdatedAt($medicoModel->updated_at);
            $medico->setDeletedAt($medicoModel->deleted_at);

            return $medico;
        }
    }