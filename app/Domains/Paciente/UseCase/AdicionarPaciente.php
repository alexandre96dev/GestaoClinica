<?php 
    namespace App\Domains\Paciente\UseCase;

    use App\Domains\Paciente\Entity\Paciente;
    use App\Domains\Paciente\Repository\PacienteRepositoryInterface;
    use App\Http\Requests\AdicionarPacienteValidacaoFiltro;
    use Illuminate\Http\Exceptions\HttpResponseException;
    use Illuminate\Http\JsonResponse;

    class AdicionarPaciente {
        private PacienteRepositoryInterface $pacienteRepository;
    
        public function __construct(PacienteRepositoryInterface $pacienteRepository)
        {
            $this->pacienteRepository = $pacienteRepository;
        }
    
        public function execute(AdicionarPacienteValidacaoFiltro $requisicaoValidada): JsonResponse
        {
            $dadosValidados = $requisicaoValidada->validated();

            $nome = $dadosValidados['nome'];

            $cpf = $dadosValidados['cpf'];

            $celular = $dadosValidados['celular'];

            $paciente = new Paciente(null, $nome, $cpf, $celular);

            $pacienteCadastrado = $this->pacienteRepository->adicionarPaciente($paciente);

            return response()->json($pacienteCadastrado);
        }
    }