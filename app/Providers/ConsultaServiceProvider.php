<?php

namespace App\Providers;

use App\Domains\Consulta\Repository\ConsultaRepositoryInterface;
use App\Infrastructure\Consulta\Persistence\Eloquent\ConsultaRepository;
use Illuminate\Support\ServiceProvider;

class ConsultaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ConsultaRepositoryInterface::class, ConsultaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
