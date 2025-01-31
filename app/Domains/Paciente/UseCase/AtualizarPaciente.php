<?php 
    namespace App\Domains\Paciente\UseCase;

    use App\Domains\Paciente\Entity\Paciente;
    use App\Domains\Paciente\Repository\PacienteRepositoryInterface;
    use App\Exceptions\PacienteNaoEncontradoException;
    use App\Http\Requests\AtualizarPacienteValidacaoFiltro;
    use Illuminate\Http\JsonResponse;

    class AtualizarPaciente {
        private PacienteRepositoryInterface $pacienteRepository;
    
        public function __construct(PacienteRepositoryInterface $pacienteRepository)
        {
            $this->pacienteRepository = $pacienteRepository;
        }
    
        public function execute(AtualizarPacienteValidacaoFiltro $requisicaoValidada): JsonResponse
        {
            $dadosValidados = $requisicaoValidada->validated();

            $pacienteId = $dadosValidados['id_paciente'];

            $nome = $dadosValidados['nome'];

            $celular = $dadosValidados['celular'];

            $pacienteEncontrado = $this->verificarSePacienteExiste($pacienteId);

            $paciente = new Paciente($pacienteEncontrado->getId(), $pacienteEncontrado->getNome(), $pacienteEncontrado->getCpf(), $pacienteEncontrado->getCelular());

            $paciente->setNome($nome);

            $paciente->setCelular($celular);

            $pacienteAtualizado = $this->pacienteRepository->atualizarPaciente($paciente);
            
            return response()->json($pacienteAtualizado);
        }


        private function verificarSePacienteExiste(int $pacienteId): Paciente{
            $pacienteEncontrado = $this->pacienteRepository->listarPorId($pacienteId);

            if(!$pacienteEncontrado){
                throw new PacienteNaoEncontradoException();
            }

            return $pacienteEncontrado;
        }
    }