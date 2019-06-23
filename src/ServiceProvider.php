<?php

namespace HerCat\V2exApi;

/**
 * Class ServiceProvider.
 *
 * @author her-cat <hxhsoft@foxmail.com>
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(V2exApi::class, function () {
            return new V2exApi();
        });

        $this->app->alias(V2exApi::class, 'v2exApi');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [V2exApi::class, 'v2exApi'];
    }
}