<?php

namespace OpenDeveloper\Developer\Config;

use OpenDeveloper\Developer\Developer;
use OpenDeveloper\Developer\Extension;

class Config extends Extension
{
    /**
     * Load configure into laravel from database.
     *
     * @return void
     */
    public static function load()
    {
        foreach (ConfigModel::all(['name', 'value']) as $config) {
            config([$config['name'] => $config['value']]);
        }
    }

    /**
     * Bootstrap this package.
     *
     * @return void
     */
    public static function boot()
    {
        static::registerRoutes();

        Developer::extend('config', __CLASS__);
    }

    /**
     * Register routes for open-developer.
     *
     * @return void
     */
    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            /* @var \Illuminate\Routing\Router $router */
            $router->resource(
                config('developer.extensions.config.name', 'config'),
                config('developer.extensions.config.controller', 'OpenDeveloper\Developer\Config\ConfigController')
            );
        });
    }

    /**
     * {@inheritdoc}
     */
    public static function import()
    {
        parent::createMenu('Config', 'config', 'icon-toggle-on');

        parent::createPermission('Developer Config', 'ext.config', 'config*');
    }
}
