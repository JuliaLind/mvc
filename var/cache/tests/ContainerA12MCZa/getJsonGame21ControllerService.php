<?php

namespace ContainerA12MCZa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getJsonGame21ControllerService extends App_KernelTestsDebugContainer
{
    /**
     * Gets the public 'App\Controller\JsonGame21Controller' shared autowired service.
     *
     * @return \App\Controller\JsonGame21Controller
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/JsonGame21Controller.php';

        $container->services['App\\Controller\\JsonGame21Controller'] = $instance = new \App\Controller\JsonGame21Controller();

        $instance->setContainer(($container->privates['.service_locator.jIxfAsi'] ?? $container->load('get_ServiceLocator_JIxfAsiService'))->withContext('App\\Controller\\JsonGame21Controller', $container));

        return $instance;
    }
}
