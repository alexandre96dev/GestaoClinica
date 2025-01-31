<?php

use App\Http\Controllers\AutenticacaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AutenticacaoController::class, 'login']);

Route::get('/cidades', [CidadeController::class, 'listarCidades']);

Route::get('/medicos', [MedicoController::class, 'listarMedicos']);

Route::get('/cidades/{id_cidade}/medicos', [MedicoController::class, 'listarMedicosDeUmaCidade']);

Route::middleware('verifica.token.jwt')->group(function () {
    Route::get('/user', [AutenticacaoController::class, 'informacoesDoUsuario']);

    Route::post('/medicos', [MedicoController::class, 'cadastrarNovoMedico']);
    Route::post('/medicos/consulta', [PacienteController::class, 'agendarConsulta']);
    Route::get('/medicos/{id_medico}/pacientes', [PacienteController::class, 'listarPacientesDoMedico']);


    Route::put('/pacientes/{id_paciente}', [PacienteController::class, 'atualizarPaciente']);
    Route::post('/pacientes', [PacienteController::class, 'adicionarPaciente']);
});