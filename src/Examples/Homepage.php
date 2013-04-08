<?php
use Silex\Application;
$app->get('/', function (Application $app) {
    return [
        '_template' => 'homepage',
        'name' => 'word',
    ];
});
