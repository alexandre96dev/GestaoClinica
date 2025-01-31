<?php
    namespace App\Infrastructure\Paciente\Persistence\Eloquent;

    use App\Domains\Paciente\Entity\Consulta;
    use App\Domains\Paciente\Entity\Paciente;
    use App\Domains\Paciente\Repository\PacienteRepositoryInterface;
    use App\Exceptions\CpfOuCelularJaCadastradoException;
    use App\Models\Paciente as PacienteModel;
    use App\Models\Consulta as ConsultaModel;
    use DateTime;

    class PacienteRepository implements PacienteRepositoryInterface
    {
        public function agendarConsulta(Consulta $consulta): Consulta
        {
            $consultaModel = new ConsultaModel();
            $consultaModel->medico_id = $consulta->getMedicoId();
            $consultaModel->paciente_id = $consulta->getPacienteId();
            $consultaModel->data = $consulta->getData();
            $consultaModel->save();

            $consulta->setCreatedAt($consultaModel->created_at);
            $consulta->setUpdatedAt($consultaModel->updated_at);
            $consulta->setDeletedAt($consultaModel->deleted_at);

            $consulta->setId($consultaModel->id);

            return $consulta;
        }

        public function listarPacientesDoMedico(int $medicoId, ?bool $apenasAgendadas, ?string $nome): array
        {
            $query = ConsultaModel::where('medico_id', $medicoId)->with('paciente');

            if ($apenasAgendadas) {
                $dataAtual = new DateTime();

                $dataAtual->format('Y-m-d H:i:s');
                
                $query->where('data', '>', $dataAtual);
            }

            if ($nome) {
                $query->whereHas('paciente', function ($q) use ($nome) {
                    $q->where('nome', 'like', '%' . $nome . '%');
                });
            }

            $consultas = $query->orderBy('data', 'asc')->get();

            $pacientes = $consultas->map(function ($consultaModel) {
                $pacienteModel = $consultaModel->paciente;
                $paciente = new Paciente($pacienteModel->id, $pacienteModel->nome, $pacienteModel->cpf, $pacienteModel->celular);
                $paciente->setCreatedAt($pacienteModel->created_at);
                $paciente->setUpdatedAt($pacienteModel->updated_at);
                $paciente->setDeletedAt($pacienteModel->deleted_at);
                $consulta = new Consulta($consultaModel->id, $consultaModel->medico_id, $consultaModel->paciente_id, $consultaModel->data);
                $paciente->agendarConsulta($consulta);

                return $paciente;
            });

            return $pacientes->toArray();
        }

        public function listarPorId(int $pacienteId): ?Paciente
        {
            $pacienteModel = PacienteModel::find($pacienteId);

            if (!$pacienteModel) {
                return null;
            }

            $paciente = new Paciente($pacienteModel->id, $pacienteModel->nome, $pacienteModel->cpf, $pacienteModel->celular);
            $paciente->setCreatedAt($pacienteModel->created_at);
            $paciente->setUpdatedAt($pacienteModel->updated_at);
            $paciente->setDeletedAt($pacienteModel->deleted_at);

            return $paciente;
        }

        public function atualizarPaciente(Paciente $paciente): Paciente {
            try {
                $pacienteModel = PacienteModel::find($paciente->getId());
                
                $pacienteModel->nome = $paciente->getNome();
                $pacienteModel->celular = $paciente->getCelular();

                $pacienteModel->save();
                $paciente->setCreatedAt($pacienteModel->created_at);
                $paciente->setUpdatedAt($pacienteModel->updated_at);
                $paciente->setDeletedAt($pacienteModel->deleted_at);

                return $paciente;
            } catch (\Throwable $th) {
                throw new CpfOuCelularJaCadastradoException();
            }
            
        }

        public function adicionarPaciente(Paciente $paciente): Paciente
        {
            try {
                $pacienteModel = new PacienteModel();
                $pacienteModel->nome = $paciente->getNome();
                $pacienteModel->cpf = $paciente->getCpf();
                $pacienteModel->celular = $paciente->getCelular();
                $pacienteModel->save();

                $paciente->setId($pacienteModel->id);
                $paciente->setCreatedAt($pacienteModel->created_at);
                $paciente->setUpdatedAt($pacienteModel->updated_at);
                $paciente->setDeletedAt($pacienteModel->deleted_at);
                
                return $paciente;
            } catch (\Throwable $th) {
                throw new CpfOuCelularJaCadastradoException();
            }
        }
    }