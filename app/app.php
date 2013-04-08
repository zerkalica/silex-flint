<?php

use Silex\Application;

use Symfony\Component\HttpKernel\Debug\ExceptionHandler;
use Symfony\Component\HttpKernel\Debug\ErrorHandler;

return function ($env = null) {
    if (empty($env)) {
        $env = 'prod';
    }
    $loader     = require __DIR__ . '/../vendor/autoload.php';
    $kernelRoot = __DIR__ . '/../app';
    $config     = require_once $kernelRoot . '/config/' . $env . '.php';

    umask(0);
    ini_set('intl.default_locale', $config['intl.default_locale']);
    setlocale(LC_ALL, $config['intl.default_locale']);
    ini_set('date.timezone', $config['date.timezone']);
    date_default_timezone_set($config['date.timezone']);

    $app = new Application($config);

    if (!empty($config['debug'])) {
        error_reporting(E_ALL | E_NOTICE | E_WARNING | E_STRICT);
        //DebugClassLoader::enable();
        ErrorHandler::register();
        if ('cli' !== php_sapi_name()) {
            $handler = new ExceptionHandler(true);
            set_exception_handler(function (\Exception $exception) use ($handler) {
                $handler->handle($exception);
            });
        }
    }

    foreach($app['providers'] as $providerClass) {
        $provider = new $providerClass;
        $app->register($provider);
    }

    $loadModule = function ($module) use ($app) {
        return require_once __DIR__ . '/../src/' . str_replace('\\', DIRECTORY_SEPARATOR, $module) . '.php';
    };

    foreach ($app['includes'] as $module) {
        $loadModule($module);
    }

    return $app;
};
