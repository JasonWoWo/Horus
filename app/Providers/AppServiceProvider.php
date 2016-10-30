<?php

namespace App\Providers;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Lavary\Menu\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerRepositoryMapping();
    }
    
    public function registerRepositoryMapping()
    {
        $repositoryMapping = config('repository.repositoryMapping');
        foreach ($repositoryMapping as $abstractRepository => $repositoryClass) {
            $this->app->bind($abstractRepository, function ($app) use ($repositoryClass) {
                $entityManager = $app[EntityManager::class];
                return new $repositoryClass($entityManager);
            });
        }
    }
}
