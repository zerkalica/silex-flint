<?php return [
    'intl.default_locale' => 'ru_RU',
    'date.timezone'       => 'Asia/Dubai',
    'lang'  => 'ru',
    'debug' => false,

    'providers' => [
        'Silex\Provider\UrlGeneratorServiceProvider',
        'Silex\Provider\ServiceControllerServiceProvider',
        'Silex\Provider\MonologServiceProvider',
        'Flint\Provider\JadeServiceProvider',
        'Flint\Provider\RestifyServiceProvider',
    ],

    'includes' => [
        'Homepage',
    ],

    'template.cache.path' => __DIR__ . '/../cache/templates',
    'template.layout'     => 'layout',
    'template.directories' => [
        __DIR__ . '/../templates'
    ],

    'monolog.logfile' => __DIR__ . '/../logs/silex_' . $env . '.log',
    'monolog.level' => \Monolog\Logger::WARNING,
];
