<?php

namespace App\Providers;

use App\Domains\Medico\Repository\MedicoRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Medico\Persistence\Eloquent\MedicoRepository;

class MedicoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MedicoRepositoryInterface::class, MedicoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
