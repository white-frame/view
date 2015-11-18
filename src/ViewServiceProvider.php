<?php namespace WhiteFrame\View;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

/**
 * Class ViewServiceProvider
 * @package WhiteFrame\View
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('WhiteFrame\View', function ($app) {
            return new \WhiteFrame\View\View();
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function (\Illuminate\View\View $view) {
            foreach(\App::make('WhiteFrame\View\View')->get($view->getName()) as $viewInfos) {
                $view->nest($viewInfos['section'], $viewInfos['view'], $viewInfos['datas']);
            }
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}