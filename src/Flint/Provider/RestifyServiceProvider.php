<?php
namespace Flint\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RestifyServiceProvider implements ServiceProviderInterface
{
    protected function isJson(Request $request)
    {
        return 0 === strpos($request->headers->get('Content-Type'), 'application/json');
    }

    protected function getData($result, Request $request, Application $app)
    {
        if ($this->isJson($request)) {
            $result = $result ? json_encode($result) : 'null';
        } else {
            if (is_array($result)) {
                $routeName = $request->get('_route');
                $pos = strpos($routeName, '_');
                if ($pos !== false) {
                    $routeName = substr($routeName, $pos + 1);
                }
                $template = str_replace('_', DIRECTORY_SEPARATOR, $routeName);

                $result = $app['template']->render($template, $result);
            }
        }

        return $result;
    }

    public function register(Application $app)
    {
        $app->before(function (Request $request) {
            if ($this->isJson($request)) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
            }
        });

        $app->on(KernelEvents::VIEW, function (GetResponseForControllerResultEvent $event) use ($app) {
            $data = $this->getData($event->getControllerResult(), $event->getRequest(), $app);
            $event->setResponse(new Response($data));
        });
    }

    public function boot(Application $app)
    {
    }
}
