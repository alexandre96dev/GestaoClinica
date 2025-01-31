<?php 
    namespace App\Domains\Paciente\UseCase;

    use App\Domains\Paciente\Entity\Consulta;
    use App\Domains\Paciente\Repository\PacienteRepositoryInterface;
    use App\Http\Requests\AgendarConsultaValidacaoFiltro;
    use Illuminate\Http\JsonResponse;
    class AgendarConsulta {
        private PacienteRepositoryInterface $pacienteRepository;
    
        public function __construct(PacienteRepositoryInterface $pacienteRepository)
        {
            $this->pacienteRepository = $pacienteRepository;
        }
    
        public function execute(AgendarConsultaValidacaoFiltro $requisicaoValidada): JsonResponse
        {

            $dadosValidados = $requisicaoValidada->validated();

            $consulta = new Consulta(null, $dadosValidados['medico_id'], $dadosValidados['paciente_id'], $dadosValidados['data']);

            $consultaAgendada = $this->pacienteRepository->agendarConsulta($consulta);

            return response()->json($consultaAgendada);
        }
    }