<?php


namespace Adizbek\GiveMeCrud;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function boot()
    {

    }
}
