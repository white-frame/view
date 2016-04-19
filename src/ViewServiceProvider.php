<?php namespace WhiteFrame\View;

use Illuminate\Support\ServiceProvider;
use WhiteFrame\Support\Environment;

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
        $this->app->singleton('white-frame.view.view', function ($app) {
            return new \WhiteFrame\View\View();
        });

        if(Environment::isLaravel()) {
            $this->app->booting(function () {
                app('Illuminate\Foundation\AliasLoader')->alias('WhiteFrame\View', 'WhiteFrame\View\ViewFacade');
            });
        }
        elseif(Environment::isLumen()) {
            class_alias('WhiteFrame\View\ViewFacade', 'WhiteFrame\View');
        }
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function (\Illuminate\View\View $view) {
            foreach(\WhiteFrame\View::getNested($view->getName()) as $name => $datas) {
                $view->nest('nested.' . $name, $name, $datas);
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