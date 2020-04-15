<?php


namespace Adizbek\Larabek;


use Adizbek\Larabek\Core\LarabekManager;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class LarabekServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/larabek.php', 'admin');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
    }

    public function boot()
    {
        $this->app->singleton('larabek', function ($app) {
            return new LarabekManager();
        });

        $this->publish();
    }

    private function publish()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../public/larabek' => public_path('vendor/larabek')
            ]);
        }
    }
}
