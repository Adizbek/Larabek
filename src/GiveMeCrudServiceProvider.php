<?php


namespace Adizbek\GiveMeCrud;


use Illuminate\Support\ServiceProvider;

class GiveMeCrudServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function boot()
    {

    }
}
