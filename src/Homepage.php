<?php

$app->get('/', function (\Silex\Application $app) {
    return [
        'name' => 'test',
    ];
})->bind('homepage');
