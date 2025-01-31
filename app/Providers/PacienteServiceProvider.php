<?php

namespace App\Providers;

use App\Domains\Paciente\Repository\PacienteRepositoryInterface;
use App\Infrastructure\Paciente\Persistence\Eloquent\PacienteRepository;
use Illuminate\Support\ServiceProvider;

class PacienteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PacienteRepositoryInterface::class, PacienteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
