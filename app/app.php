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
        if ('cli' !== php_sapi_name()) {
            ExceptionHandler::register($config['debug']);
        }
        //DebugClassLoader::enable();
        ErrorHandler::register();
    }

    $providers   = $config['providers'];
    $controllers = $config['resources'];
    $includes    = $config['includes'];
    unset($config['providers'], $config['resources'], $config['includes']);

    foreach($providers as $providerClass) {
        $provider = new $providerClass;
        $app->register($provider, $config);
    }

    foreach($controllers as $prefix => $controllerClass) {
        $controller = new $controllerClass;
        $app->mount($prefix, $controller);
    }

    $loadModule = function ($module) use ($app) {
        return require_once __DIR__ . '/../src/' . str_replace('\\', DIRECTORY_SEPARATOR, $module) . '.php';
    };

    foreach ($includes as $module) {
        $loadModule($module);
    }


    return $app;
};
