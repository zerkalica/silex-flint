<?php return array_merge(require __DIR__ . '/prod.php', [
    'lang'  => 'ru',
    'debug' => true,
    'db'    => parse_ini_file(__DIR__ . '/db/loc.ini'),

    'monolog.level' => \Monolog\Logger::WARNING,
]);
