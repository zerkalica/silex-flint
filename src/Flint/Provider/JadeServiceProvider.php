<?php
namespace Flint\Provider;

use Flint\Template\JadeEngine;
use Silex\Application;
use Silex\ServiceProviderInterface;

class JadeServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['template'] = $app->share(function ($app) {
            return new JadeEngine($app['template.cache.path'], $app['template.directories']);
        });
    }

    public function boot(Application $app) {}
}
