<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domains\Cidade\Repository\CidadeRepositoryInterface;
use App\Infrastructure\Cidade\Persistence\Eloquent\CidadeRepository;

class CidadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CidadeRepositoryInterface::class, CidadeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
