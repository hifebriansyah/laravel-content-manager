<?php
 
namespace MFebriansyah\LaravelContentManager;
 
use Illuminate\Support\ServiceProvider;
 
class LaravelContentManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'lcm');

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
    }
 
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}