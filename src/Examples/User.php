<?php
namespace Examples;

use Silex\Application;
use Silex\ControllerProviderInterface;

class User implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        /** @var $controllers Application */
        $controllers = $app['controllers_factory'];

        $controllers->get('{userId}{json}', function ($userId) {
            return [
                '_template' => 'examples/user/view',
                'id'   => $userId,
                'name' => 'test user',
            ];
        })
            ->assert('userId', '\d+')
            ->assert('json', '.*')
            ->value('json', '');

        return $controllers;
    }
}
