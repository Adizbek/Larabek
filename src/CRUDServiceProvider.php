<?php


namespace Adizbek\GiveMeCrud;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class CRUDServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'admin');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
    }

    public function boot()
    {
        $this->app->singleton('crud', function ($app) {
           return new CRUDManager();
        });
    }
}
