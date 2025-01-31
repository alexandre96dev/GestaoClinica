<?php

namespace App\Providers;

use App\Domains\Autenticacao\Repository\AutenticacaoRepositoryInterface;
use App\Infrastructure\Autenticacao\Persistence\Eloquent\AutenticacaoRepository;
use Illuminate\Support\ServiceProvider;

class AutenticacaoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AutenticacaoRepositoryInterface::class, AutenticacaoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
