<?php

/*
 * This file is part of the her-cat/v2ex-api.
 *
 * (c) her-cat <hxhsoft@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
