<?php 
    namespace App\Domains\Paciente\UseCase;

    use App\Domains\Paciente\Repository\PacienteRepositoryInterface;
    use App\Http\Requests\ListarPacientesDoMedicoValidacaoFiltro;
    use Illuminate\Http\JsonResponse;

    class ListarPacientesDeUmMedico {
        private PacienteRepositoryInterface $pacienteRepository;
    
        public function __construct(PacienteRepositoryInterface $pacienteRepository)
        {
            $this->pacienteRepository = $pacienteRepository;
        }
    
        public function execute(ListarPacientesDoMedicoValidacaoFiltro $requisicaoValidada): JsonResponse
        {

            $dadosValidados = $requisicaoValidada->validated();

            $apenasAgendadas = $dadosValidados['apenas-agendadas'] ?? null;

            $nome = $dadosValidados['nome'] ?? null;

            $medicoId = $dadosValidados['id_medico'];

            $pacientesDoMedico = $this->pacienteRepository->listarPacientesDoMedico($medicoId, $apenasAgendadas, $nome);

            return response()->json($pacientesDoMedico);
        }
    }